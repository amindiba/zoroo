/**
 * اسکریپت اصلی قالب زورو
 * 
 * @package Zoro_Theme
 * @since 1.0.0
 */

(function($) {
    'use strict';

    // اشیاء اصلی
    const Zoro = {
        
        /**
         * راه‌اندازی اولیه
         */
        init: function() {
            this.bindEvents();
            this.initSearch();
            this.initComparison();
            this.initMobileMenu();
        },

        /**
         * ثبت رویدادها
         */
        bindEvents: function() {
            // کلیک روی دکمه‌های افزودن به مقایسه
            $(document).on('click', '[data-action="add-to-compare"]', this.addToCompare);
            
            // کلیک روی دکمه‌های حذف از مقایسه
            $(document).on('click', '[data-action="remove-from-compare"]', this.removeFromCompare);
            
            // ارسال فرم جستجوی هوشمند
            $(document).on('submit', '.smart-search-form', this.handleSmartSearch);
            
            // کلیک روی دکمه درخواست خرید
            $(document).on('click', '[data-action="request-purchase"]', this.handlePurchaseRequest);
        },

        /**
         * راه‌اندازی جستجوی هوشمند
         */
        initSearch: function() {
            const searchInput = $('.smart-search-input');
            
            if (searchInput.length) {
                // فعال‌سازی autocomplete
                searchInput.autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: zoroData.restUrl + 'smart-search',
                            method: 'GET',
                            data: {
                                q: request.term,
                                _wpnonce: zoroData.nonce
                            },
                            success: function(data) {
                                response(data.suggestions);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        console.log('انتخاب شده:', ui.item.label);
                    }
                });
            }
        },

        /**
         * راه‌اندازی سیستم مقایسه
         */
        initComparison: function() {
            // بارگذاری محصولات مقایسه از localStorage
            const compareList = JSON.parse(localStorage.getItem('zoro_compare_list') || '[]');
            
            if (compareList.length > 0) {
                $('.compare-count').text(compareList.length);
                $('.compare-bar').removeClass('hidden');
            }
        },

        /**
         * افزودن به لیست مقایسه
         */
        addToCompare: function(e) {
            e.preventDefault();
            
            const productId = $(this).data('product-id');
            const productName = $(this).data('product-name');
            
            let compareList = JSON.parse(localStorage.getItem('zoro_compare_list') || '[]');
            
            if (compareList.length >= 4) {
                alert('حداکثر ۴ محصول را می‌توانید مقایسه کنید');
                return;
            }
            
            if (!compareList.includes(productId)) {
                compareList.push(productId);
                localStorage.setItem('zoro_compare_list', JSON.stringify(compareList));
                
                $('.compare-count').text(compareList.length);
                $('.compare-bar').removeClass('hidden');
                
                // نمایش پیام موفقیت
                Zoro.showNotification(productName + ' به لیست مقایسه اضافه شد', 'success');
            }
        },

        /**
         * حذف از لیست مقایسه
         */
        removeFromCompare: function(e) {
            e.preventDefault();
            
            const productId = $(this).data('product-id');
            
            let compareList = JSON.parse(localStorage.getItem('zoro_compare_list') || '[]');
            compareList = compareList.filter(id => id !== productId);
            
            localStorage.setItem('zoro_compare_list', JSON.stringify(compareList));
            
            if (compareList.length === 0) {
                $('.compare-bar').addClass('hidden');
            } else {
                $('.compare-count').text(compareList.length);
            }
            
            // حذف از UI
            $(this).closest('.compare-item').remove();
        },

        /**
         * پردازش جستجوی هوشمند
         */
        handleSmartSearch: function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const query = $form.find('.search-query').val();
            const $resultsContainer = $('.search-results');
            
            if (!query.trim()) {
                return;
            }
            
            // نمایش لودینگ
            $resultsContainer.html('<div class="loading">در حال جستجو...</div>');
            
            $.ajax({
                url: zoroData.restUrl + 'smart-search',
                method: 'GET',
                data: {
                    q: query,
                    _wpnonce: zoroData.nonce
                },
                success: function(response) {
                    Zoro.renderSearchResults(response, $resultsContainer);
                },
                error: function() {
                    $resultsContainer.html('<div class="error">خطا در جستجو. لطفاً دوباره تلاش کنید.</div>');
                }
            });
        },

        /**
         * نمایش نتایج جستجو
         */
        renderSearchResults: function(response, container) {
            if (!response.products || response.products.length === 0) {
                container.html('<div class="no-results">محصولی یافت نشد</div>');
                return;
            }
            
            let html = '<div class="products-grid">';
            
            response.products.forEach(function(product) {
                html += `
                    <div class="product-card card">
                        <img src="${product.image}" alt="${product.name}" class="card-image">
                        <div class="card-content">
                            <h3 class="card-title">${product.name}</h3>
                            <p class="card-text">${product.excerpt}</p>
                            <div class="product-meta">
                                <span class="price">${product.price}</span>
                                <span class="manufacturer">${product.manufacturer}</span>
                            </div>
                            <div class="product-actions">
                                <a href="${product.url}" class="btn btn-primary">مشاهده جزئیات</a>
                                <button data-action="add-to-compare" data-product-id="${product.id}" data-product-name="${product.name}" class="btn btn-secondary">مقایسه</button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            container.html(html);
        },

        /**
         * پردازش درخواست خرید
         */
        handlePurchaseRequest: function(e) {
            e.preventDefault();
            
            const productId = $(this).data('product-id');
            
            // باز کردن مودال درخواست خرید
            Zoro.openPurchaseModal(productId);
        },

        /**
         * باز کردن مودال درخواست خرید
         */
        openPurchaseModal: function(productId) {
            const modalHtml = `
                <div class="modal-overlay">
                    <div class="modal">
                        <div class="modal-header">
                            <h3>درخواست خرید</h3>
                            <button class="modal-close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form class="purchase-request-form">
                                <input type="hidden" name="product_id" value="${productId}">
                                <div class="form-group">
                                    <label for="customer_name">نام و نام خانوادگی</label>
                                    <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_email">ایمیل</label>
                                    <input type="email" id="customer_email" name="customer_email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_phone">شماره تماس</label>
                                    <input type="tel" id="customer_phone" name="customer_phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="product_details">توضیحات تکمیلی</label>
                                    <textarea id="product_details" name="product_details" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">ارسال درخواست</button>
                                    <button type="button" class="btn btn-secondary modal-close">انصراف</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            `;
            
            $('body').append(modalHtml);
        },

        /**
         * نمایش پیام اعلان
         */
        showNotification: function(message, type) {
            const notification = $(`
                <div class="notification notification-${type}">
                    ${message}
                    <button class="notification-close">&times;</button>
                </div>
            `);
            
            $('body').append(notification);
            
            setTimeout(function() {
                notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        },

        /**
         * راه‌اندازی منوی موبایل
         */
        initMobileMenu: function() {
            const menuToggle = $('.mobile-menu-toggle');
            const mobileMenu = $('.mobile-menu');
            
            menuToggle.on('click', function() {
                mobileMenu.toggleClass('active');
                $(this).toggleClass('active');
            });
        }
    };

    // راه‌اندازی هنگام لود شدن DOM
    $(document).ready(function() {
        Zoro.init();
    });

})(jQuery);
