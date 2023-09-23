<?php

remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb");
remove_action(
    "woocommerce_before_main_content",
    "woocommerce_catalog_ordering",
);

// Output the page hero layout
function page_hero()
{
    echo '<section class="collections">';
    echo '<div class="container page-hero">';

    echo '<h1 class="page-title">' . the_archive_title() . "</h1>";

    echo "</div>";
    echo "</section>";
}

add_action("woocommerce_before_main_content", "page_hero");

// Register the custom layout function
function archive_layout()
{
    // Your custom layout code here
}

add_action("woocommerce_before_main_content", "archive_layout", 10);
