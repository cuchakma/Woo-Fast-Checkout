<?php

$cart_products = WC()->cart->get_cart();

?>

	<div class="shopping-cart">

		<div class="column-labels">
			<label class="product-image">Image</label>
			<label class="product-details">Product</label>
			<label class="product-price">Price</label>
			<label class="product-quantity">Quantity</label>
			<label class="product-removal">Remove</label>
			<label class="product-line-price">Total</label>
		</div>

		<?php
			foreach ( $cart_products as $cart_key => $cart_item ) {
				$product_id   = $cart_item['product_id'];
				$product_data = $cart_item['data'];
				if ( empty( $product_data ) || ! $product_data->exists() || $cart_item['quantity'] < 0 ) {
					continue;
				}
				$product_permalink = get_permalink( $product_id );
				$product_name      = $product_data->get_name();
				$product_price     = $product_data->get_price();
				$product_qty       = $cart_item['quantity'];
				$product_thumbnail = $product_data->get_image();
				$product_subtotal  = WC()->cart->get_product_subtotal( $product_data, $product_qty );
				?>
					<div class="product">
						<div class="product-image">
							<?php echo $product_thumbnail; ?>
						</div>
						<div class="product-details">
							<div class="product-title"><?php echo $product_name; ?></div>
						</div>
						<div class="product-price"><?php echo $product_price; ?></div>
							<div class="product-quantity">
							<input type="number" value="<?php echo $product_qty; ?>" min="1">
						</div>
						<div class="product-removal">
							<?php printf( '<a href="%s" class="remove-product" data-product-id="%d" data-product-sku="%d">%s</a>', esc_url( wc_get_cart_remove_url( $cart_key ) ), filter_var( $product_id, FILTER_SANITIZE_NUMBER_INT ), filter_var( $product_qty, FILTER_SANITIZE_NUMBER_INT ), 'Remove' ); ?>
						</div>
						<div class="product-line-price"><?php echo $product_price; ?></div>
					</div>
				<?php
			}
		?>

		<div class="totals">
			<div class="totals-item">
			<label>Subtotal</label>
			<div class="totals-value" id="cart-subtotal">71.97</div>
			</div>
			<div class="totals-item">
			<label>Tax (5%)</label>
			<div class="totals-value" id="cart-tax">3.60</div>
			</div>
			<div class="totals-item">
			<label>Shipping</label>
			<div class="totals-value" id="cart-shipping">15.00</div>
			</div>
			<div class="totals-item totals-item-total">
			<label>Grand Total</label>
			<div class="totals-value" id="cart-total">90.57</div>
			</div>
		</div>
			
			<button class="checkout">Checkout</button>

	</div>

<?php


