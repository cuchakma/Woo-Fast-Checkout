jQuery(document).ready(
    (function ($) {
        woo_update_cart();
        woo_remove_product();

        function woo_remove_product() {
            $(document).on("click", "a.wfc_remove_product", function (e) {
                e.preventDefault();
                e.stopPropagation();
                var cart_item_key = $(this).attr("data-cart_item_key");
                data = { cart_item_key: cart_item_key };
                $.ajax({
                    type: "POST",
                    url: wfc_datas.wc_ajax_url.toString().replace("%%endpoint%%", "wfc_remove_product"),
                    data: data,
                    beforeSend: function () {
                        initializeLoader();
                    },
                    success: function (response) {
                        jQuery(document.body).trigger("wc_fragment_refresh");
                        if ($(".mbh-information.mbh-notification-box").length) {
                            $(".mbh-information.mbh-notification-box").remove();
                            $(".shopping_cart_title").after(response.fragments.product_removed_notice);
                        } else {
                            $(".shopping_cart_title").after(response.fragments.product_removed_notice);
                        }
                        removeLoader();
                    },
                });
            });
        }

        function woo_update_cart() {
            $(document).on("click", ".sc_btn_update button", function (e) {
                initializeLoader();
                setTimeout(function (e) {
                    removeLoader();
                }, 1000);
            });
        }

        function initializeLoader() {
            $("svg.wfc-loader").css("display", "block");
            $("section.wfc_shopping_cart_content").addClass("wfc_meta");
        }

        function removeLoader() {
            $("svg.wfc-loader").css("display", "none");
            $("section.wfc_shopping_cart_content").removeClass("wfc_meta");
        }
    })(jQuery)
);
