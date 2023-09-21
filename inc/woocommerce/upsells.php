<?php
/**
 * WooCommerce Single Product Page Customization
 * Insert Upsells as Product Table After ADD TO CART
 */

function upsells_table()
{
	if (is_product()) {
		global $product;

		if ($product->is_type("simple") || $product->is_type("variable")) {
			// Get upsell IDs
			$upsells = $product->get_upsells();

			if ($upsells) { ?>
<h2 class="upsell-title">Frequently Bought Together</h2>
<table class="upsells">
  <tbody>
    <?php foreach ($upsells as $id) {

    	$upsell_product = wc_get_product($id);

    	if (!$upsell_product) {
    		continue;
    	}

    	$permalink = esc_url($upsell_product->get_permalink());
    	$image = get_the_post_thumbnail(
    		$id,
    		[60, 60],
    		["class" => "upsell-image", "alt" => $upsell_product->get_name()],
    	);
    	$name = esc_html($upsell_product->get_name());
    	$price = wc_price(esc_html($product->get_price()));
    	?>
    <tr>
      <td>
        <figure>
          <a href="<?php echo $permalink; ?>">
            <?php echo $image; ?>
          </a>
          <figcaption class="screen-reader-text"><?php echo $name; ?>
          </figcaption>
        </figure>
      </td>

      <td>
        <h3> <?php echo $name; ?></h3>
      </td>

      <td>
        <?php echo $price; ?>
      </td>

      <td>
        <a href="<?php echo $permalink; ?>" class="more-info" title="More info">i</a>
      </td>

    </tr>
    <?php
    } ?>
  </tbody>
</table>
<?php }
		}
	}
}
