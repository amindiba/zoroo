<?php
/**
 * کلاس مدیریت تولیدکنندگان
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Zoro_Manufacturers {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_filter('template_include', array($this, 'manufacturer_template'));
        add_action('wp_ajax_get_manufacturers', array($this, 'ajax_get_manufacturers'));
        add_action('wp_ajax_nopriv_get_manufacturers', array($this, 'ajax_get_manufacturers'));
    }
    
    /**
     * استفاده از قالب سفارشی برای صفحات تولیدکننده
     */
    public function manufacturer_template($template) {
        if (is_singular('manufacturer')) {
            $custom_template = locate_template('templates/single-manufacturer.php');
            if ($custom_template) {
                return $custom_template;
            }
        }
        
        if (is_post_type_archive('manufacturer')) {
            $custom_template = locate_template('templates/archive-manufacturer.php');
            if ($custom_template) {
                return $custom_template;
            }
        }
        
        return $template;
    }
    
    /**
     * دریافت لیست تولیدکنندگان از طریق AJAX
     */
    public function ajax_get_manufacturers() {
        $args = array(
            'post_type'      => 'manufacturer',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        
        // فیلتر بر اساس صنعت
        if (isset($_GET['industry'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'industry_category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['industry']),
                ),
            );
        }
        
        // جستجو
        if (isset($_GET['search'])) {
            $args['s'] = sanitize_text_field($_GET['search']);
        }
        
        $manufacturers = get_posts($args);
        
        $response = array();
        
        foreach ($manufacturers as $manufacturer) {
            $response[] = array(
                'id'          => $manufacturer->ID,
                'name'        => get_the_title($manufacturer),
                'slug'        => $manufacturer->post_name,
                'excerpt'     => wp_trim_words($manufacturer->post_content, 30),
                'logo'        => get_the_post_thumbnail_url($manufacturer->ID, 'manufacturer-logo'),
                'url'         => get_permalink($manufacturer->ID),
                'established' => get_post_meta($manufacturer->ID, '_zoro_established_year', true),
                'employees'   => get_post_meta($manufacturer->ID, '_zoro_employees_count', true),
                'products_count' => $this->count_manufacturer_products($manufacturer->ID),
            );
        }
        
        wp_send_json_success($response);
    }
    
    /**
     * شمارش محصولات یک تولیدکننده
     */
    private function count_manufacturer_products($manufacturer_id) {
        $products = get_posts(array(
            'post_type'      => 'industrial_product',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => array(
                array(
                    'key'   => '_zoro_manufacturer_id',
                    'value' => $manufacturer_id,
                ),
            ),
        ));
        
        return count($products);
    }
    
    /**
     * دریافت اطلاعات کامل تولیدکننده
     */
    public static function get_manufacturer_details($manufacturer_id) {
        $manufacturer = get_post($manufacturer_id);
        
        if (!$manufacturer || $manufacturer->post_type !== 'manufacturer') {
            return null;
        }
        
        return array(
            'id'           => $manufacturer_id,
            'name'         => get_the_title($manufacturer_id),
            'content'      => apply_filters('the_content', $manufacturer->post_content),
            'excerpt'      => get_the_excerpt($manufacturer_id),
            'logo'         => get_the_post_thumbnail_url($manufacturer_id, 'full'),
            'established'  => get_post_meta($manufacturer_id, '_zoro_established_year', true),
            'employees'    => get_post_meta($manufacturer_id, '_zoro_employees_count', true),
            'certifications' => get_post_meta($manufacturer_id, '_zoro_certifications', true),
            'website'      => get_post_meta($manufacturer_id, '_zoro_website', true),
            'address'      => get_post_meta($manufacturer_id, '_zoro_address', true),
            'phone'        => get_post_meta($manufacturer_id, '_zoro_phone', true),
            'email'        => get_post_meta($manufacturer_id, '_zoro_email', true),
            'products'     => self::get_manufacturer_products($manufacturer_id),
            'rating'       => self::get_manufacturer_rating($manufacturer_id),
            'reviews_count' => self::get_manufacturer_reviews_count($manufacturer_id),
        );
    }
    
    /**
     * دریافت محصولات تولیدکننده
     */
    public static function get_manufacturer_products($manufacturer_id, $limit = 12) {
        $products = get_posts(array(
            'post_type'      => 'industrial_product',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                    'key'   => '_zoro_manufacturer_id',
                    'value' => $manufacturer_id,
                ),
            ),
        ));
        
        $result = array();
        
        foreach ($products as $product) {
            $result[] = array(
                'id'    => $product->ID,
                'title' => get_the_title($product),
                'url'   => get_permalink($product->ID),
                'image' => get_the_post_thumbnail_url($product->ID, 'product-card'),
                'price' => zoro_format_price(get_post_meta($product->ID, '_zoro_price', true)),
            );
        }
        
        return $result;
    }
    
    /**
     * دریافت امتیاز تولیدکننده
     */
    public static function get_manufacturer_rating($manufacturer_id) {
        $products = self::get_manufacturer_products($manufacturer_id, -1);
        
        if (empty($products)) {
            return 0;
        }
        
        $total_rating = 0;
        $count = 0;
        
        foreach ($products as $product) {
            $rating = get_post_meta($product['id'], '_zoro_average_rating', true);
            if ($rating) {
                $total_rating += floatval($rating);
                $count++;
            }
        }
        
        return $count > 0 ? round($total_rating / $count, 2) : 0;
    }
    
    /**
     * دریافت تعداد نظرات تولیدکننده
     */
    public static function get_manufacturer_reviews_count($manufacturer_id) {
        $products = self::get_manufacturer_products($manufacturer_id, -1);
        
        $total_reviews = 0;
        
        foreach ($products as $product) {
            $total_reviews += intval(get_post_meta($product['id'], '_zoro_reviews_count', true));
        }
        
        return $total_reviews;
    }
    
    /**
     * نمایش کارت تولیدکننده
     */
    public static function render_manufacturer_card($manufacturer_id) {
        $data = self::get_manufacturer_details($manufacturer_id);
        
        if (!$data) {
            return '';
        }
        
        ob_start();
        ?>
        <div class="manufacturer-card card">
            <div class="card-content">
                <?php if ($data['logo']): ?>
                    <img src="<?php echo esc_url($data['logo']); ?>" alt="<?php echo esc_attr($data['name']); ?>" class="manufacturer-logo">
                <?php endif; ?>
                
                <h3 class="manufacturer-name">
                    <a href="<?php echo esc_url($data['url']); ?>">
                        <?php echo esc_html($data['name']); ?>
                    </a>
                </h3>
                
                <p class="manufacturer-excerpt"><?php echo esc_html($data['excerpt']); ?></p>
                
                <div class="manufacturer-meta">
                    <?php if ($data['established']): ?>
                        <span class="established">تأسیس: <?php echo esc_html($data['established']); ?></span>
                    <?php endif; ?>
                    
                    <?php if ($data['employees']): ?>
                        <span class="employees">کارکنان: <?php echo esc_html(zoro_to_persian_digits($data['employees'])); ?></span>
                    <?php endif; ?>
                    
                    <?php if ($data['products_count']): ?>
                        <span class="products-count">محصولات: <?php echo esc_html(zoro_to_persian_digits($data['products_count'])); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="manufacturer-rating">
                    <span class="rating-stars"><?php echo str_repeat('★', floor($data['rating'])); ?></span>
                    <span class="rating-value"><?php echo esc_html(zoro_to_persian_digits($data['rating'])); ?></span>
                    <span class="reviews-count">(<?php echo esc_html(zoro_to_persian_digits($data['reviews_count'])); ?> نظر)</span>
                </div>
                
                <a href="<?php echo esc_url($data['url']); ?>" class="btn btn-primary">مشاهده پروفایل</a>
            </div>
        </div>
        <?php
        
        return ob_get_clean();
    }
}

Zoro_Manufacturers::get_instance();
