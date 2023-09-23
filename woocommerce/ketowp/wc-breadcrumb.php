<?php

/**
 * Change several of the breadcrumb defaults
 */
add_filter("woocommerce_breadcrumb_defaults", "ketowp_wc_breadcrumb");
function ketowp_wc_breadcrumb()
{
    return [
        "delimiter" => '<span class="separator">/</span>',
        "wrap_before" =>
            '<nav class="wc-breadcrumb" itemprop="breadcrumb"><ul>',
        "wrap_after" => "</ul></nav>",
        "before" => "<li>",
        "after" => "</li>",
        "home" => _x("Home", "breadcrumb", "woocommerce"),
    ];
}
