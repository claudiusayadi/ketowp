<?php

/**
 * Change several of the breadcrumb defaults
 */
add_filter("woocommerce_breadcrumb_defaults", "ketowp_wc_breadcrumb");
function ketowp_wc_breadcrumb()
{
    return [
        "delimiter" => '<span class="separator mx-1">/</span>',
        "wrap_before" =>
            '<nav class="wc-breadcrumb opacity-35" itemprop="breadcrumb"><ul class="flex items-center gap-1">',
        "wrap_after" => "</ul></nav>",
        "before" => '<li class="last:underline last:underline-offset-1 hover:opacity-100">',
        "after" => "</li>",
        "home" => _x("Home", "breadcrumb", "woocommerce"),
    ];
}
