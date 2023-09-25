<?php
/**
 * Show cart contents / total Ajax
 */
add_filter("woocommerce_add_to_cart_fragments", "ajax_mini_cart");

function ajax_mini_cart($fragments)
{
    global $woocommerce;

    ob_start();
    ?>
<span class="cart-bag__count">
  <?php echo WC()->cart->get_cart_contents_count(); ?>
</span>
<?php
$fragments["span.cart-bag__count"] = ob_get_clean();
return $fragments;
}
