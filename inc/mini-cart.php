<?php

if (!defined("ABSPATH")) {
	exit();
}

/* ARIAL LABEL FOR MINI CART */
add_filter("bricks/element/render_attributes", "as_minicart_link_aria_label", 10, 3);
function as_minicart_link_aria_label($attributes, $key, $element_instance)
{
	if ($element_instance->name == "woocommerce-mini-cart" && $key == "a") {
		$attributes["a"]["aria-label"] = "Adun Studio Mini Cart";
	}
	return $attributes;
}
