<?php

// To modify the WooCommerce content wrapper start and end

add_action(
    "woocommerce_before_main_content",
    "woocommerce_output_content_wrapper",
);

// overwrite existing output content wrapper function
function woocommerce_output_content_wrapper()
{
    echo '<main id="site-content" role="main">';
}

add_action(
    "woocommerce_after_main_content",
    "woocommerce_output_content_wrapper_end",
);

function woocommerce_output_content_wrapper_end()
{
    echo "</main>";
}
