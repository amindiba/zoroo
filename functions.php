<?php
/**
 * توابع اصلی قالب زورو | چشم بازار
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // خروج مستقیم ممنوع
}

/**
 * تعریف ثابت‌های قالب
 */
define('ZORO_VERSION', '1.0.0');
define('ZORO_DIR', get_template_directory());
define('ZORO_URI', get_template_directory_uri());
define('ZORO_INC_DIR', ZORO_DIR . '/inc/');
define('ZORO_ASSETS_URI', ZORO_URI . '/assets/');

/**
 * بارگذاری فایل‌های کلاس
 */
require_once ZORO_INC_DIR . 'class-zoro-setup.php';
require_once ZORO_INC_DIR . 'class-zoro-post-types.php';
require_once ZORO_INC_DIR . 'class-zoro-search.php';
require_once ZORO_INC_DIR . 'class-zoro-comparison.php';
require_once ZORO_INC_DIR . 'class-zoro-manufacturers.php';
require_once ZORO_INC_DIR . 'class-zoro-surveys.php';

/**
 * راه‌اندازی قالب
 */
function zoro_setup() {
    // افزودن پشتیبانی از تصاویر شاخص
    add_theme_support('post-thumbnails');
    
    // افزودن پشتیبانی از تگ title
    add_theme_support('title-tag');
    
    // افزودن پشتیبانی از RSS Feed
    add_theme_support('automatic-feed-links');
    
    // افزودن پشتیبانی از HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // افزودن پشتیبانی از ویرایشگر بلوک
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    
    // افزودن پشتیبانی از لوگوی سفارشی
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // افزودن پشتیبانی از پس‌زمینه سفارشی
    add_theme_support('custom-background');
    
    // ثبت منوها
    register_nav_menus(array(
        'primary'   => __('منوی اصلی', 'zoro'),
        'footer'    => __('منوی پاورقی', 'zoro'),
        'mobile'    => __('منوی موبایل', 'zoro'),
    ));
    
    // تنظیم عرض محتوا
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'zoro_setup');

/**
 * فراخوانی استایل‌ها و اسکریپت‌ها
 */
function zoro_scripts() {
    // استایل اصلی
    wp_enqueue_style(
        'zoro-style',
        ZORO_ASSETS_URI . 'css/style.css',
        array(),
        ZORO_VERSION
    );
    
    // استایل RTL برای فارسی
    if (is_rtl()) {
        wp_enqueue_style(
            'zoro-rtl',
            ZORO_ASSETS_URI . 'css/rtl.css',
            array('zoro-style'),
            ZORO_VERSION
        );
    }
    
    // اسکریپت اصلی
    wp_enqueue_script(
        'zoro-main',
        ZORO_ASSETS_URI . 'js/main.js',
        array('jquery'),
        ZORO_VERSION,
        true
    );
    
    // ارسال متغیرها به جاوااسکریپت
    wp_localize_script('zoro-main', 'zoroData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('zoro_nonce'),
        'restUrl' => rest_url('zoro/v1/'),
    ));
    
    // بارگذاری کامنت‌ها در صفحات تک
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'zoro_scripts');

/**
 * ثبت نواحی ویجت
 */
function zoro_widgets_init() {
    register_sidebar(array(
        'name'          => __('نوار کناری', 'zoro'),
        'id'            => 'sidebar-1',
        'description'   => __('ویجت‌ها را به اینجا بکشید', 'zoro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('پاورقی ستون ۱', 'zoro'),
        'id'            => 'footer-1',
        'description'   => __('ویجت‌های پاورقی', 'zoro'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('پاورقی ستون ۲', 'zoro'),
        'id'            => 'footer-2',
        'description'   => __('ویجت‌های پاورقی', 'zoro'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('پاورقی ستون ۳', 'zoro'),
        'id'            => 'footer-3',
        'description'   => __('ویجت‌های پاورقی', 'zoro'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'zoro_widgets_init');

/**
 * افزودن کلاس‌های سفارشی به منو
 */
function zoro_nav_menu_css_class($classes, $item, $args) {
    if ($args->menu_location === 'primary') {
        $classes[] = 'primary-menu-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'zoro_nav_menu_css_class', 10, 3);

/**
 * کوتاه کردن متن
 */
function zoro_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'zoro_excerpt_length');

/**
 * تغییر ادامه متن
 */
function zoro_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'zoro_excerpt_more');

/**
 * افزودن کلاس بدنه سفارشی
 */
function zoro_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    if (is_singular('industrial_product')) {
        $classes[] = 'single-product';
    }
    
    if (is_post_type_archive('industrial_product')) {
        $classes[] = 'products-archive';
    }
    
    return $classes;
}
add_filter('body_class', 'zoro_body_classes');

/**
 * غیرفعال کردن Gutenberg در صورت نیاز
 */
// add_filter('use_block_editor_for_post', '__return_false');

/**
 * افزودن سایزهای تصویر سفارشی
 */
function zoro_custom_image_sizes() {
    add_image_size('product-card', 400, 300, true);
    add_image_size('product-large', 800, 600, true);
    add_image_size('manufacturer-logo', 200, 100, true);
    add_image_size('hero-image', 1920, 600, true);
}
add_action('after_setup_theme', 'zoro_custom_image_sizes');

/**
 * MIME types مجاز برای آپلود
 */
function zoro_mime_types($mimes) {
    $mimes['pdf'] = 'application/pdf';
    $mimes['dwg'] = 'application/acad';
    $mimes['dxf'] = 'application/dxf';
    return $mimes;
}
add_filter('upload_mimes', 'zoro_mime_types');

/**
 * زمان خواندن پست
 */
function zoro_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    return sprintf(
        _n('%d دقیقه مطالعه', '%d دقیقه مطالعه', $reading_time, 'zoro'),
        $reading_time
    );
}

/**
 * مسیر نان‌ریزه (Breadcrumb)
 */
function zoro_breadcrumb() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav class="breadcrumb" aria-label="' . esc_attr__('مسیر', 'zoro') . '">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . __('خانه', 'zoro') . '</a>';
    
    if (is_category() || is_single()) {
        echo ' <span class="separator">/</span> ';
        the_category(' <span class="separator">/</span> ');
        
        if (is_single()) {
            echo ' <span class="separator">/</span> ';
            the_title('<span>', '</span>');
        }
    } elseif (is_page()) {
        echo ' <span class="separator">/</span> ';
        echo '<span>' . get_the_title() . '</span>';
    } elseif (is_search()) {
        echo ' <span class="separator">/</span> ';
        echo '<span>' . __('نتایج جستجو', 'zoro') . '</span>';
    }
    
    echo '</nav>';
}

/**
 * بررسی اینکه آیا کاربر تولیدکننده است
 */
function zoro_is_manufacturer($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    return user_can($user_id, 'manage_manufacturers');
}

/**
 * دریافت اطلاعات تولیدکننده
 */
function zoro_get_manufacturer_info($product_id = null) {
    if (!$product_id) {
        $product_id = get_the_ID();
    }
    
    $manufacturer_id = get_post_meta($product_id, '_zoro_manufacturer_id', true);
    
    if ($manufacturer_id) {
        return get_post($manufacturer_id);
    }
    
    return null;
}

/**
 * نمایش قیمت با فرمت فارسی
 */
function zoro_format_price($price, $currency = 'IRR') {
    $formatted = number_format($price, 0, ',', ',');
    
    switch ($currency) {
        case 'USD':
            return $formatted . ' $';
        case 'EUR':
            return $formatted . ' €';
        case 'IRR':
        default:
            return $formatted . ' ریال';
    }
}

/**
 * تبدیل عدد انگلیسی به فارسی
 */
function zoro_to_persian_digits($string) {
    $persian_digits = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    return str_replace(range(0, 9), $persian_digits, $string);
}

/**
 * ثبت REST API Route برای جستجوی هوشمند
 */
function zoro_register_rest_routes() {
    register_rest_route('zoro/v1', '/smart-search', array(
        'methods'             => 'GET',
        'callback'            => 'zoro_smart_search_callback',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('zoro/v1', '/compare-products', array(
        'methods'             => 'POST',
        'callback'            => 'zoro_compare_products_callback',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('zoro/v1', '/submit-inquiry', array(
        'methods'             => 'POST',
        'callback'            => 'zoro_submit_inquiry_callback',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'zoro_register_rest_routes');

/**
 * پردازش درخواست خرید
 */
function zoro_process_purchase_request($data) {
    // ایجاد پست درخواست خرید
    $request_id = wp_insert_post(array(
        'post_type'   => 'purchase_request',
        'post_title'  => $data['product_name'],
        'post_status' => 'publish',
    ));
    
    if ($request_id) {
        update_post_meta($request_id, '_zoro_customer_name', sanitize_text_field($data['customer_name']));
        update_post_meta($request_id, '_zoro_customer_email', sanitize_email($data['customer_email']));
        update_post_meta($request_id, '_zoro_customer_phone', sanitize_text_field($data['customer_phone']));
        update_post_meta($request_id, '_zoro_product_details', sanitize_textarea_field($data['product_details']));
        update_post_meta($request_id, '_zoro_request_status', 'pending');
        
        return $request_id;
    }
    
    return false;
}
