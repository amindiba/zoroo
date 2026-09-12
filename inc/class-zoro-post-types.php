<?php
/**
 * ثبت انواع پست‌های سفارشی
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Zoro_Post_Types {
    
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
        add_action('init', array($this, 'register_post_types'));
    }
    
    /**
     * ثبت انواع پست سفارشی
     */
    public function register_post_types() {
        $this->register_industrial_product();
        $this->register_manufacturer();
        $this->register_survey();
        $this->register_purchase_request();
    }
    
    /**
     * ثبت پست تایپ محصول صنعتی
     */
    private function register_industrial_product() {
        $labels = array(
            'name'                  => __('محصولات صنعتی', 'zoro'),
            'singular_name'         => __('محصول صنعتی', 'zoro'),
            'menu_name'             => __('محصولات', 'zoro'),
            'name_admin_bar'        => __('محصول', 'zoro'),
            'add_new'               => __('افزودن جدید', 'zoro'),
            'add_new_item'          => __('افزودن محصول جدید', 'zoro'),
            'new_item'              => __('محصول جدید', 'zoro'),
            'edit_item'             => __('ویرایش محصول', 'zoro'),
            'view_item'             => __('مشاهده محصول', 'zoro'),
            'all_items'             => __('همه محصولات', 'zoro'),
            'search_items'          => __('جستجوی محصولات', 'zoro'),
            'parent_item_colon'     => __('محصول والد:', 'zoro'),
            'not_found'             => __('محصولی یافت نشد', 'zoro'),
            'not_found_in_trash'    => __('محصولی در زباله‌دان یافت نشد', 'zoro'),
        );
        
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'product'),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'menu_icon'             => 'dashicons-admin-settings',
            'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
            'show_in_rest'          => true,
            'rest_base'             => 'products',
            'taxonomies'            => array('category', 'post_tag', 'industry_category', 'product_type', 'product_tag'),
        );
        
        register_post_type('industrial_product', $args);
    }
    
    /**
     * ثبت پست تایپ تولیدکننده
     */
    private function register_manufacturer() {
        $labels = array(
            'name'                  => __('تولیدکنندگان', 'zoro'),
            'singular_name'         => __('تولیدکننده', 'zoro'),
            'menu_name'             => __('تولیدکنندگان', 'zoro'),
            'name_admin_bar'        => __('تولیدکننده', 'zoro'),
            'add_new'               => __('افزودن جدید', 'zoro'),
            'add_new_item'          => __('افزودن تولیدکننده جدید', 'zoro'),
            'new_item'              => __('تولیدکننده جدید', 'zoro'),
            'edit_item'             => __('ویرایش تولیدکننده', 'zoro'),
            'view_item'             => __('مشاهده تولیدکننده', 'zoro'),
            'all_items'             => __('همه تولیدکنندگان', 'zoro'),
            'search_items'          => __('جستجوی تولیدکنندگان', 'zoro'),
            'parent_item_colon'     => __('تولیدکننده والد:', 'zoro'),
            'not_found'             => __('تولیدکننده‌ای یافت نشد', 'zoro'),
            'not_found_in_trash'    => __('تولیدکننده‌ای در زباله‌دان یافت نشد', 'zoro'),
        );
        
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'manufacturer'),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 21,
            'menu_icon'             => 'dashicons-building',
            'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'show_in_rest'          => true,
            'rest_base'             => 'manufacturers',
            'taxonomies'            => array('industry_category'),
        );
        
        register_post_type('manufacturer', $args);
    }
    
    /**
     * ثبت پست تایپ نظرسنجی
     */
    private function register_survey() {
        $labels = array(
            'name'                  => __('نظرسنجی‌ها', 'zoro'),
            'singular_name'         => __('نظرسنجی', 'zoro'),
            'menu_name'             => __('نظرسنجی‌ها', 'zoro'),
            'name_admin_bar'        => __('نظرسنجی', 'zoro'),
            'add_new'               => __('افزودن جدید', 'zoro'),
            'add_new_item'          => __('افزودن نظرسنجی جدید', 'zoro'),
            'new_item'              => __('نظرسنجی جدید', 'zoro'),
            'edit_item'             => __('ویرایش نظرسنجی', 'zoro'),
            'view_item'             => __('مشاهده نظرسنجی', 'zoro'),
            'all_items'             => __('همه نظرسنجی‌ها', 'zoro'),
            'search_items'          => __('جستجوی نظرسنجی‌ها', 'zoro'),
            'not_found'             => __('نظرسنجی یافت نشد', 'zoro'),
            'not_found_in_trash'    => __('نظرسنجی در زباله‌دان یافت نشد', 'zoro'),
        );
        
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'survey'),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 22,
            'menu_icon'             => 'dashicons-feedback',
            'supports'              => array('title', 'editor', 'custom-fields'),
            'show_in_rest'          => true,
            'rest_base'             => 'surveys',
        );
        
        register_post_type('survey', $args);
    }
    
    /**
     * ثبت پست تایپ درخواست خرید
     */
    private function register_purchase_request() {
        $labels = array(
            'name'                  => __('درخواست‌های خرید', 'zoro'),
            'singular_name'         => __('درخواست خرید', 'zoro'),
            'menu_name'             => __('درخواست‌های خرید', 'zoro'),
            'name_admin_bar'        => __('درخواست خرید', 'zoro'),
            'add_new'               => __('افزودن جدید', 'zoro'),
            'add_new_item'          => __('ثبت درخواست جدید', 'zoro'),
            'new_item'              => __('درخواست جدید', 'zoro'),
            'edit_item'             => __('ویرایش درخواست', 'zoro'),
            'view_item'             => __('مشاهده درخواست', 'zoro'),
            'all_items'             => __('همه درخواست‌ها', 'zoro'),
            'search_items'          => __('جستجوی درخواست‌ها', 'zoro'),
            'not_found'             => __('درخواستی یافت نشد', 'zoro'),
            'not_found_in_trash'    => __('درخواستی در زباله‌دان یافت نشد', 'zoro'),
        );
        
        $args = array(
            'labels'                => $labels,
            'public'                => false,
            'publicly_queryable'    => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => false,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 23,
            'menu_icon'             => 'dashicons-cart',
            'supports'              => array('title', 'custom-fields'),
            'show_in_rest'          => false,
        );
        
        register_post_type('purchase_request', $args);
    }
    
    /**
     * ثبت متا باکس‌ها
     */
    public function register_meta_boxes() {
        // متا باکس اطلاعات محصول
        add_meta_box(
            'zoro_product_details',
            __('اطلاعات محصول', 'zoro'),
            array($this, 'render_product_meta_box'),
            'industrial_product',
            'normal',
            'high'
        );
        
        // متا باکس اطلاعات تولیدکننده
        add_meta_box(
            'zoro_manufacturer_details',
            __('اطلاعات تولیدکننده', 'zoro'),
            array($this, 'render_manufacturer_meta_box'),
            'manufacturer',
            'normal',
            'high'
        );
    }
    
    /**
     * نمایش متا باکس محصول
     */
    public function render_product_meta_box($post) {
        wp_nonce_field('zoro_save_product_meta', 'zoro_product_meta_nonce');
        
        $price = get_post_meta($post->ID, '_zoro_price', true);
        $model = get_post_meta($post->ID, '_zoro_model', true);
        $warranty = get_post_meta($post->ID, '_zoro_warranty', true);
        $stock_status = get_post_meta($post->ID, '_zoro_stock_status', true);
        
        ?>
        <table class="form-table">
            <tr>
                <th><label for="zoro_price"><?php _e('قیمت (ریال)', 'zoro'); ?></label></th>
                <td><input type="number" id="zoro_price" name="zoro_price" value="<?php echo esc_attr($price); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="zoro_model"><?php _e('مدل', 'zoro'); ?></label></th>
                <td><input type="text" id="zoro_model" name="zoro_model" value="<?php echo esc_attr($model); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="zoro_warranty"><?php _e('مدت گارانتی (ماه)', 'zoro'); ?></label></th>
                <td><input type="number" id="zoro_warranty" name="zoro_warranty" value="<?php echo esc_attr($warranty); ?>" class="small-text"></td>
            </tr>
            <tr>
                <th><label for="zoro_stock_status"><?php _e('وضعیت موجودی', 'zoro'); ?></label></th>
                <td>
                    <select id="zoro_stock_status" name="zoro_stock_status">
                        <option value="in-stock" <?php selected($stock_status, 'in-stock'); ?>><?php _e('موجود', 'zoro'); ?></option>
                        <option value="out-of-stock" <?php selected($stock_status, 'out-of-stock'); ?>><?php _e('ناموجود', 'zoro'); ?></option>
                        <option value="pre-order" <?php selected($stock_status, 'pre-order'); ?>><?php _e('پیش‌خرید', 'zoro'); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * نمایش متا باکس تولیدکننده
     */
    public function render_manufacturer_meta_box($post) {
        wp_nonce_field('zoro_save_manufacturer_meta', 'zoro_manufacturer_meta_nonce');
        
        $established_year = get_post_meta($post->ID, '_zoro_established_year', true);
        $employees_count = get_post_meta($post->ID, '_zoro_employees_count', true);
        $certifications = get_post_meta($post->ID, '_zoro_certifications', true);
        $website = get_post_meta($post->ID, '_zoro_website', true);
        
        ?>
        <table class="form-table">
            <tr>
                <th><label for="zoro_established_year"><?php _e('سال تأسیس', 'zoro'); ?></label></th>
                <td><input type="number" id="zoro_established_year" name="zoro_established_year" value="<?php echo esc_attr($established_year); ?>" class="small-text"></td>
            </tr>
            <tr>
                <th><label for="zoro_employees_count"><?php _e('تعداد کارکنان', 'zoro'); ?></label></th>
                <td><input type="number" id="zoro_employees_count" name="zoro_employees_count" value="<?php echo esc_attr($employees_count); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="zoro_certifications"><?php _e('گواهینامه‌ها', 'zoro'); ?></label></th>
                <td><textarea id="zoro_certifications" name="zoro_certifications" rows="4" class="large-text"><?php echo esc_textarea($certifications); ?></textarea></td>
            </tr>
            <tr>
                <th><label for="zoro_website"><?php _e('وب‌سایت', 'zoro'); ?></label></th>
                <td><input type="url" id="zoro_website" name="zoro_website" value="<?php echo esc_url($website); ?>" class="regular-text"></td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * ذخیره متا داده‌های محصول
     */
    public function save_product_meta($post_id) {
        if (!isset($_POST['zoro_product_meta_nonce']) || !wp_verify_nonce($_POST['zoro_product_meta_nonce'], 'zoro_save_product_meta')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (isset($_POST['zoro_price'])) {
            update_post_meta($post_id, '_zoro_price', sanitize_text_field($_POST['zoro_price']));
        }
        
        if (isset($_POST['zoro_model'])) {
            update_post_meta($post_id, '_zoro_model', sanitize_text_field($_POST['zoro_model']));
        }
        
        if (isset($_POST['zoro_warranty'])) {
            update_post_meta($post_id, '_zoro_warranty', sanitize_text_field($_POST['zoro_warranty']));
        }
        
        if (isset($_POST['zoro_stock_status'])) {
            update_post_meta($post_id, '_zoro_stock_status', sanitize_text_field($_POST['zoro_stock_status']));
        }
    }
    
    /**
     * ذخیره متا داده‌های تولیدکننده
     */
    public function save_manufacturer_meta($post_id) {
        if (!isset($_POST['zoro_manufacturer_meta_nonce']) || !wp_verify_nonce($_POST['zoro_manufacturer_meta_nonce'], 'zoro_save_manufacturer_meta')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (isset($_POST['zoro_established_year'])) {
            update_post_meta($post_id, '_zoro_established_year', sanitize_text_field($_POST['zoro_established_year']));
        }
        
        if (isset($_POST['zoro_employees_count'])) {
            update_post_meta($post_id, '_zoro_employees_count', sanitize_text_field($_POST['zoro_employees_count']));
        }
        
        if (isset($_POST['zoro_certifications'])) {
            update_post_meta($post_id, '_zoro_certifications', sanitize_textarea_field($_POST['zoro_certifications']));
        }
        
        if (isset($_POST['zoro_website'])) {
            update_post_meta($post_id, '_zoro_website', esc_url_raw($_POST['zoro_website']));
        }
    }
}

// اجرای کلاس
$post_types = Zoro_Post_Types::get_instance();
add_action('add_meta_boxes', array($post_types, 'register_meta_boxes'));
add_action('save_post_industrial_product', array($post_types, 'save_product_meta'));
add_action('save_post_manufacturer', array($post_types, 'save_manufacturer_meta'));
