<?php
/**
 * راه‌اندازی اولیه قالب
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Zoro_Setup {
    
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
        $this->init_hooks();
    }
    
    /**
     * ثبت هوک‌ها
     */
    private function init_hooks() {
        add_action('init', array($this, 'register_taxonomies'));
        add_action('init', array($this, 'register_user_roles'));
        add_filter('wp_mail_content_type', array($this, 'set_email_content_type'));
    }
    
    /**
     * ثبت طبقه‌بندی‌های سفارشی
     */
    public function register_taxonomies() {
        // طبقه‌بندی صنایع
        register_taxonomy('industry_category', array('industrial_product', 'manufacturer'), array(
            'labels' => array(
                'name'              => __('دسته‌بندی صنایع', 'zoro'),
                'singular_name'     => __('دسته صنعت', 'zoro'),
                'search_items'      => __('جستجوی دسته‌ها', 'zoro'),
                'all_items'         => __('همه دسته‌ها', 'zoro'),
                'edit_item'         => __('ویرایش دسته', 'zoro'),
                'update_item'       => __('به‌روزرسانی دسته', 'zoro'),
                'add_new_item'      => __('افزودن دسته جدید', 'zoro'),
                'new_item_name'     => __('نام دسته جدید', 'zoro'),
                'parent_item'       => __('دسته والد', 'zoro'),
                'parent_item_colon' => __('دسته والد:', 'zoro'),
            ),
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'industry'),
            'show_in_rest'      => true,
        ));
        
        // طبقه‌بندی نوع محصول
        register_taxonomy('product_type', 'industrial_product', array(
            'labels' => array(
                'name'              => __('انواع محصول', 'zoro'),
                'singular_name'     => __('نوع محصول', 'zoro'),
                'search_items'      => __('جستجوی انواع', 'zoro'),
                'all_items'         => __('همه انواع', 'zoro'),
                'edit_item'         => __('ویرایش نوع', 'zoro'),
                'update_item'       => __('به‌روزرسانی نوع', 'zoro'),
                'add_new_item'      => __('افزودن نوع جدید', 'zoro'),
                'new_item_name'     => __('نام نوع جدید', 'zoro'),
            ),
            'hierarchical'      => false,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'product-type'),
            'show_in_rest'      => true,
        ));
        
        // طبقه‌بندی برچسب‌ها
        register_taxonomy('product_tag', 'industrial_product', array(
            'labels' => array(
                'name'                       => __('برچسب‌ها', 'zoro'),
                'singular_name'              => __('برچسب', 'zoro'),
                'search_items'               => __('جستجوی برچسب‌ها', 'zoro'),
                'popular_items'              => __('برچسب‌های محبوب', 'zoro'),
                'all_items'                  => __('همه برچسب‌ها', 'zoro'),
                'edit_item'                  => __('ویرایش برچسب', 'zoro'),
                'update_item'                => __('به‌روزرسانی برچسب', 'zoro'),
                'add_new_item'               => __('افزودن برچسب جدید', 'zoro'),
                'new_item_name'              => __('نام برچسب جدید', 'zoro'),
                'separate_items_with_commas' => __('برچسب‌ها را با کاما جدا کنید', 'zoro'),
                'add_or_remove_items'        => __('افزودن یا حذف برچسب‌ها', 'zoro'),
                'choose_from_most_used'      => __('انتخاب از پرمصرف‌ترین‌ها', 'zoro'),
            ),
            'hierarchical'      => false,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'product-tag'),
            'show_in_rest'      => true,
        ));
    }
    
    /**
     * ثبت نقش‌های کاربری سفارشی
     */
    public function register_user_roles() {
        // نقش تولیدکننده
        add_role(
            'manufacturer',
            __('تولیدکننده', 'zoro'),
            array(
                'read'                  => true,
                'edit_posts'            => true,
                'delete_posts'          => true,
                'upload_files'          => true,
                'manage_manufacturers'  => true,
            )
        );
        
        // نقش کارشناس
        add_role(
            'expert',
            __('کارشناس', 'zoro'),
            array(
                'read'                  => true,
                'edit_posts'            => true,
                'delete_posts'          => true,
                'upload_files'          => true,
                'moderate_comments'     => true,
                'manage_categories'     => true,
            )
        );
        
        // نقش مشتری ویژه
        add_role(
            'vip_customer',
            __('مشتری ویژه', 'zoro'),
            array(
                'read'                  => true,
                'upload_files'          => true,
            )
        );
    }
    
    /**
     * تنظیم نوع محتوای ایمیل به HTML
     */
    public function set_email_content_type() {
        return 'text/html';
    }
    
    /**
     * ایجاد صفحات پیش‌فرض
     */
    public static function create_default_pages() {
        $pages = array(
            'home' => array(
                'title'   => __('صفحه اصلی', 'zoro'),
                'content' => '',
            ),
            'products' => array(
                'title'   => __('محصولات', 'zoro'),
                'content' => '',
            ),
            'manufacturers' => array(
                'title'   => __('تولیدکنندگان', 'zoro'),
                'content' => '',
            ),
            'comparison' => array(
                'title'   => __('مقایسه محصولات', 'zoro'),
                'content' => '',
            ),
            'surveys' => array(
                'title'   => __('نظرسنجی‌ها', 'zoro'),
                'content' => '',
            ),
            'contact' => array(
                'title'   => __('تماس با ما', 'zoro'),
                'content' => '',
            ),
        );
        
        foreach ($pages as $key => $page_data) {
            $existing_page = get_page_by_path($key);
            
            if (!$existing_page) {
                wp_insert_post(array(
                    'post_title'   => $page_data['title'],
                    'post_content' => $page_data['content'],
                    'post_name'    => $key,
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                ));
            }
        }
    }
}

// اجرای کلاس
Zoro_Setup::get_instance();
