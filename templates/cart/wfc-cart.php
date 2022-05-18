<?php
/**
 * WooCommerce Cart Page
 *
 * This Template Can Be Overwritten Inside A Theme
 *
 * @version 0.0.1
 */
?>
	<!-- Cart Content start -->
	<section class="wfc_shopping_cart_content">

		<div class="container">

			<div class="row">

				<h4 class="shopping_cart_title pt-2 pb-3">Cart Info</h4>

				<?php if ( ! $cart_status ) { ?>

					<table class="wfc-table table table-bordered table-responsive">
						
						<?php wfc_load_template( 'wfc-cart-headers.php', array( '' ), 'woocommerce-fast-checkout/templates/cart', WFC_TEMPLATES . 'cart/' ); ?>
						
						<?php
						wfc_load_template(
							'wfc-product-list.php',
							array(
								'cart_products' => $cart_products,
								'cart_status'   => $cart_status,
							),
							'woocommerce-fast-checkout/templates/cart',
							WFC_TEMPLATES . 'cart/'
						);
						?>
						
					</table>

						<?php wfc_load_template( 'wfc-cart-others.php', array( '' ), 'woocommerce-fast-checkout/templates/cart', WFC_TEMPLATES . 'cart/' ); ?>


				<?php } else { ?>
					
						<?php
						wfc_load_template(
							'wfc-product-list.php',
							array(
								'cart_products' => $cart_products,
								'cart_status'   => $cart_status,
							),
							'woocommerce-fast-checkout/templates/cart',
							WFC_TEMPLATES . 'cart/'
						);
						?>

					<?php } ?>

			</div>

			<?php if ( ! $cart_status ) { ?>
					
					<?php wfc_load_template( 'wfc-cart-coupon.php', array( 'cart_products' => $cart_products ), 'woocommerce-fast-checkout/templates/cart', WFC_TEMPLATES . 'cart/' ); ?>

					<?php wfc_load_template( 'wfc-cart-total.php', array( 'cart_products' => $cart_products ), 'woocommerce-fast-checkout/templates/cart', WFC_TEMPLATES . 'cart/' ); ?>

			<?php } ?>

		</div>	
	</section>
	<!-- Cart Content end -->
<?php


