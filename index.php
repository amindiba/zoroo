<?php
/**
 * فایل اصلی قالب - ورودی
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // خروج مستقیم ممنوع
}

// بارگذاری هدر
get_header();

?>

<main class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('templates/template-parts/content', get_post_type());
        endwhile;
        
        // نمایش صفحه‌بندی
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('قبلی', 'zoro'),
            'next_text' => __('بعدی', 'zoro'),
        ));
        
    else :
        get_template_part('templates/template-parts/content', 'none');
    endif;
    ?>
</main>

<?php
// بارگذاری فوتر
get_footer();
