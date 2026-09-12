<?php
/**
 * کلاس مقایسه محصولات
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Zoro_Comparison {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('rest_api_init', array($this, 'register_compare_endpoint'));
        add_shortcode('zoro_comparison', array($this, 'render_comparison_shortcode'));
    }
    
    public function register_compare_endpoint() {
        register_rest_route('zoro/v1', '/compare-products', array(
            'methods'             => 'POST',
            'callback'            => array($this, 'compare_products_callback'),
            'permission_callback' => '__return_true',
            'args'                => array(
                'products' => array(
                    'required'          => true,
                    'type'              => 'array',
                    'sanitize_callback' => array($this, 'sanitize_product_ids'),
                    'validate_callback' => array($this, 'validate_product_ids'),
                ),
            ),
        ));
    }
    
    public function sanitize_product_ids($value) {
        return array_map('absint', $value);
    }
    
    public function validate_product_ids($value, $request, $param) {
        if (!is_array($value) || count($value) < 2 || count($value) > 4) {
            return new WP_Error('invalid_count', 'باید بین ۲ تا ۴ محصول را انتخاب کنید');
        }
        return true;
    }
    
    public function compare_products_callback($request) {
        $product_ids = $request->get_param('products');
        
        $comparison_data = array();
        
        foreach ($product_ids as $product_id) {
            $product = get_post($product_id);
            
            if (!$product || $product->post_type !== 'industrial_product') {
                continue;
            }
            
            $comparison_data[] = array(
                'id'           => $product_id,
                'name'         => get_the_title($product_id),
                'image'        => get_the_post_thumbnail_url($product_id, 'product-card'),
                'price'        => zoro_format_price(get_post_meta($product_id, '_zoro_price', true)),
                'model'        => get_post_meta($product_id, '_zoro_model', true),
                'warranty'     => get_post_meta($product_id, '_zoro_warranty', true),
                'manufacturer' => $this->get_manufacturer_info($product_id),
                'specs'        => $this->get_product_specs($product_id),
                'rating'       => get_post_meta($product_id, '_zoro_average_rating', true) ?: 0,
                'url'          => get_permalink($product_id),
            );
        }
        
        return rest_ensure_response(array(
            'success' => true,
            'products' => $comparison_data,
        ));
    }
    
    private function get_manufacturer_info($product_id) {
        $manufacturer_id = get_post_meta($product_id, '_zoro_manufacturer_id', true);
        
        if ($manufacturer_id) {
            return array(
                'id'   => $manufacturer_id,
                'name' => get_the_title($manufacturer_id),
                'logo' => get_the_post_thumbnail_url($manufacturer_id, 'manufacturer-logo'),
            );
        }
        
        return null;
    }
    
    private function get_product_specs($product_id) {
        $content = get_post_field('post_content', $product_id);
        $specs = array();
        
        // استخراج مشخصات از محتوا
        preg_match_all('/<li>(.*?)<\/li>/s', $content, $matches);
        
        if (!empty($matches[1])) {
            $specs = array_slice($matches[1], 0, 10);
        }
        
        return $specs;
    }
    
    public function render_comparison_shortcode($atts) {
        $atts = shortcode_atts(array(
            'ids' => '',
        ), $atts, 'zoro_comparison');
        
        if (empty($atts['ids'])) {
            return '';
        }
        
        $product_ids = array_map('absint', explode(',', $atts['ids']));
        
        ob_start();
        ?>
        <div class="comparison-table-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th class="feature-column">ویژگی</th>
                        <?php foreach ($product_ids as $id): ?>
                            <th><?php echo esc_html(get_the_title($id)); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>تصویر</td>
                        <?php foreach ($product_ids as $id): ?>
                            <td>
                                <?php if (has_post_thumbnail($id)): ?>
                                    <?php echo get_the_post_thumbnail($id, 'product-card'); ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>قیمت</td>
                        <?php foreach ($product_ids as $id): ?>
                            <td><?php echo zoro_format_price(get_post_meta($id, '_zoro_price', true)); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>مدل</td>
                        <?php foreach ($product_ids as $id): ?>
                            <td><?php echo esc_html(get_post_meta($id, '_zoro_model', true)); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>گارانتی</td>
                        <?php foreach ($product_ids as $id): ?>
                            <td><?php echo esc_html(get_post_meta($id, '_zoro_warranty', true)); ?> ماه</td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>تولیدکننده</td>
                        <?php foreach ($product_ids as $id): ?>
                            <td>
                                <?php
                                $manufacturer_id = get_post_meta($id, '_zoro_manufacturer_id', true);
                                if ($manufacturer_id) {
                                    echo esc_html(get_the_title($manufacturer_id));
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
            <div class="comparison-actions">
                <?php foreach ($product_ids as $id): ?>
                    <a href="<?php echo esc_url(get_permalink($id)); ?>" class="btn btn-primary">مشاهده جزئیات</a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

Zoro_Comparison::get_instance();
