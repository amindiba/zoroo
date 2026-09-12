<?php
/**
 * کلاس جستجوی هوشمند
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Zoro_Search {
    
    /**
     * نمونه یکتا
     */
    private static $instance = null;
    
    /**
     * دریافت نمونه یکتا
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * سازنده کلاس
     */
    private function __construct() {
        add_action('rest_api_init', array($this, 'register_search_endpoint'));
        add_filter('pre_get_posts', array($this, 'modify_search_query'));
    }
    
    /**
     * ثبت endpoint جستجو در REST API
     */
    public function register_search_endpoint() {
        register_rest_route('zoro/v1', '/smart-search', array(
            'methods'             => 'GET',
            'callback'            => array($this, 'smart_search_callback'),
            'permission_callback' => '__return_true',
            'args'                => array(
                'q' => array(
                    'required'          => true,
                    'type'              => 'string',
                    'sanitize_callback' => 'sanitize_text_field',
                    'validate_callback' => array($this, 'validate_search_query'),
                ),
                'category' => array(
                    'required'          => false,
                    'type'              => 'integer',
                    'sanitize_callback' => 'absint',
                ),
                'manufacturer' => array(
                    'required'          => false,
                    'type'              => 'integer',
                    'sanitize_callback' => 'absint',
                ),
                'min_price' => array(
                    'required'          => false,
                    'type'              => 'number',
                    'sanitize_callback' => 'floatval',
                ),
                'max_price' => array(
                    'required'          => false,
                    'type'              => 'number',
                    'sanitize_callback' => 'floatval',
                ),
                'orderby' => array(
                    'required'          => false,
                    'type'              => 'string',
                    'default'           => 'relevance',
                    'enum'              => array('relevance', 'price', 'date', 'rating'),
                ),
                'order' => array(
                    'required'          => false,
                    'type'              => 'string',
                    'default'           => 'DESC',
                    'enum'              => array('ASC', 'DESC'),
                ),
            ),
        ));
    }
    
    /**
     * اعتبارسنجی کوئری جستجو
     */
    public function validate_search_query($value, $request, $param) {
        if (empty($value) || strlen($value) < 2) {
            return new WP_Error('invalid_query', 'عبارت جستجو باید حداقل ۲ کاراکتر باشد');
        }
        return true;
    }
    
    /**
     * پردازش درخواست جستجوی هوشمند
     */
    public function smart_search_callback($request) {
        $query = $request->get_param('q');
        $category = $request->get_param('category');
        $manufacturer = $request->get_param('manufacturer');
        $min_price = $request->get_param('min_price');
        $max_price = $request->get_param('max_price');
        $orderby = $request->get_param('orderby');
        $order = $request->get_param('order');
        
        // تجزیه و تحلیل عبارت جستجو با NLP ساده
        $parsed_query = $this->parse_search_query($query);
        
        // ساخت کوئری وردپرس
        $args = array(
            'post_type'      => 'industrial_product',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            's'              => $parsed_query['keywords'],
        );
        
        // فیلتر دسته‌بندی
        if ($category) {
            $args['tax_query'][] = array(
                'taxonomy' => 'industry_category',
                'field'    => 'term_id',
                'terms'    => $category,
            );
        }
        
        // فیلتر تولیدکننده
        if ($manufacturer) {
            $args['meta_query'][] = array(
                'key'   => '_zoro_manufacturer_id',
                'value' => $manufacturer,
            );
        }
        
        // فیلتر قیمت
        if ($min_price || $max_price) {
            $args['meta_query'][] = array(
                'key'     => '_zoro_price',
                'value'   => array($min_price ?: 0, $max_price ?: PHP_INT_MAX),
                'type'    => 'NUMERIC',
                'compare' => 'BETWEEN',
            );
        }
        
        // مرتب‌سازی
        switch ($orderby) {
            case 'price':
                $args['meta_key'] = '_zoro_price';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = $order;
                break;
            case 'date':
                $args['orderby'] = 'date';
                $args['order']   = $order;
                break;
            case 'rating':
                $args['meta_key'] = '_zoro_average_rating';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = $order;
                break;
            default:
                $args['orderby'] = 'relevance';
                break;
        }
        
        // اجرای کوئری
        $wp_query = new WP_Query($args);
        
        // فرمت‌دهی نتایج
        $products = array();
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            $product_id = get_the_ID();
            
            $products[] = array(
                'id'           => $product_id,
                'name'         => get_the_title(),
                'excerpt'      => wp_trim_words(get_the_excerpt(), 20),
                'content'      => get_the_content(),
                'image'        => get_the_post_thumbnail_url($product_id, 'product-card') ?: $this->get_placeholder_image(),
                'price'        => zoro_format_price(get_post_meta($product_id, '_zoro_price', true)),
                'price_raw'    => get_post_meta($product_id, '_zoro_price', true),
                'manufacturer' => $this->get_manufacturer_name($product_id),
                'url'          => get_permalink($product_id),
                'rating'       => get_post_meta($product_id, '_zoro_average_rating', true) ?: 0,
                'stock_status' => get_post_meta($product_id, '_zoro_stock_status', true),
            );
        }
        
        wp_reset_postdata();
        
        // تولید پیشنهادات
        $suggestions = $this->generate_suggestions($query);
        
        return rest_ensure_response(array(
            'success'      => true,
            'total'        => $wp_query->found_posts,
            'products'     => $products,
            'suggestions'  => $suggestions,
            'filters'      => $this->get_available_filters($args),
        ));
    }
    
    /**
     * تجزیه و تحلیل عبارت جستجو
     */
    private function parse_search_query($query) {
        $result = array(
            'keywords'     => '',
            'product_type' => '',
            'brand'        => '',
            'intent'       => 'search',
        );
        
        // لیست کلمات کلیدی صنعتی
        $industrial_keywords = array(
            'موتور', 'پمپ', 'کمپرسور', 'ژنراتور', 'گیربکس',
            'الکتروموتور', 'فن', 'بلوئر', 'هیدرولیک', 'پنوماتیک',
        );
        
        // بررسی نوع محصول
        foreach ($industrial_keywords as $keyword) {
            if (stripos($query, $keyword) !== false) {
                $result['product_type'] = $keyword;
                break;
            }
        }
        
        // استخراج کلمات کلیدی اصلی
        $stop_words = array('یک', 'یک', 'خوب', 'بهترین', 'ارزان', 'قیمت', 'خرید');
        $words = explode(' ', $query);
        $keywords = array_filter($words, function($word) use ($stop_words) {
            return !in_array($word, $stop_words) && mb_strlen($word) > 2;
        });
        
        $result['keywords'] = implode(' ', $keywords);
        
        // تشخیص قصد کاربر
        if (stripos($query, 'قیمت') !== false || stripos('ارزان', $query) !== false) {
            $result['intent'] = 'price';
        } elseif (stripos($query, 'بهترین') !== false || stripos($query, 'خوب', $query) !== false) {
            $result['intent'] = 'recommendation';
        }
        
        return $result;
    }
    
    /**
     * تولید پیشنهادات جستجو
     */
    private function generate_suggestions($query) {
        $suggestions = array();
        
        // دریافت اصطلاحات مرتبط از دیتابیس
        $related_terms = get_terms(array(
            'taxonomy'   => 'product_tag',
            'search'     => $query,
            'number'     => 5,
            'fields'     => 'names',
            'hide_empty' => false,
        ));
        
        if (!is_wp_error($related_terms)) {
            foreach ($related_terms as $term) {
                $suggestions[] = array(
                    'label' => $term,
                    'value' => $term,
                    'type'  => 'tag',
                );
            }
        }
        
        // پیشنهاد محصولات محبوب
        $popular_products = get_posts(array(
            'post_type'      => 'industrial_product',
            'posts_per_page' => 3,
            'meta_key'       => '_zoro_view_count',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        ));
        
        foreach ($popular_products as $product) {
            $suggestions[] = array(
                'label' => get_the_title($product),
                'value' => get_the_title($product),
                'type'  => 'product',
                'id'    => $product->ID,
            );
        }
        
        return $suggestions;
    }
    
    /**
     * دریافت نام تولیدکننده
     */
    private function get_manufacturer_name($product_id) {
        $manufacturer_id = get_post_meta($product_id, '_zoro_manufacturer_id', true);
        
        if ($manufacturer_id) {
            return get_the_title($manufacturer_id);
        }
        
        return 'نامشخص';
    }
    
    /**
     * دریافت تصویر پیش‌فرض
     */
    private function get_placeholder_image() {
        return ZORO_ASSETS_URI . 'images/placeholder-product.png';
    }
    
    /**
     * دریافت فیلترهای موجود
     */
    private function get_available_filters($args) {
        $filters = array(
            'categories'   => array(),
            'manufacturers' => array(),
            'price_range'   => array('min' => 0, 'max' => 0),
        );
        
        // دریافت دسته‌بندی‌ها
        $categories = get_terms(array(
            'taxonomy'   => 'industry_category',
            'hide_empty' => true,
        ));
        
        if (!is_wp_error($categories)) {
            foreach ($categories as $cat) {
                $filters['categories'][] = array(
                    'id'    => $cat->term_id,
                    'name'  => $cat->name,
                    'slug'  => $cat->slug,
                    'count' => $cat->count,
                );
            }
        }
        
        // دریافت محدوده قیمت
        global $wpdb;
        $price_range = $wpdb->get_row("
            SELECT MIN(meta_value) as min_price, MAX(meta_value) as max_price
            FROM {$wpdb->postmeta}
            WHERE meta_key = '_zoro_price'
        ");
        
        if ($price_range) {
            $filters['price_range'] = array(
                'min' => (int) $price_range->min_price,
                'max' => (int) $price_range->max_price,
            );
        }
        
        return $filters;
    }
    
    /**
     * اصلاح کوئری جستجوی وردپرس
     */
    public function modify_search_query($query) {
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            $query->set('post_type', array('industrial_product', 'post'));
            $query->set('posts_per_page', 12);
        }
    }
}

// اجرای کلاس
Zoro_Search::get_instance();
