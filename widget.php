<?php

// Register a widget area for the sidebar
add_action("widgets_init", "ketowp_register_sidebar");
function ketowp_register_sidebar()
{
    register_sidebar([
        "name" => __("KetoWP Filters", "ketowp"),
        "id" => "ketowp-filters",
        "description" => __(
            "Sidebar widget housing all the default WooCommerce Product Filters.",
            "ketowp",
        ),
        "before_widget" => '<aside id="%1$s" class="widget %2$s">',
        "after_widget" => "</aside>",
        "before_title" => '<h3 class="widget-title">',
        "after_title" => "</h3>",
    ]);
}
