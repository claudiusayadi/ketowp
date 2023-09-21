<?php

// Link the WooCommerce folder
$woocommerce_directory = get_template_directory() . "/inc/woocommerce/";
$templates = scandir($woocommerce_directory);

foreach ($templates as $template) {
    if (pathinfo($template, PATHINFO_EXTENSION) === "php") {
        require_once $woocommerce_directory . $template;
    }
}
?>
