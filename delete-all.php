<?php
// Get the global WordPress database connection
global $wpdb;

// Delete all posts
$wpdb->query("DELETE FROM {$wpdb->posts} WHERE 1");

// Delete all post meta data
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE 1");

// Delete all categories
$wpdb->query("DELETE FROM {$wpdb->terms} WHERE 1");

// Delete all category relationships
$wpdb->query("DELETE FROM {$wpdb->term_relationships} WHERE 1");

// Delete all tags
$wpdb->query("DELETE FROM {$wpdb->terms} WHERE 1");

// Delete all tag relationships
$wpdb->query("DELETE FROM {$wpdb->term_relationships} WHERE 1");

// Delete all images (media attachments)
$wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = 'attachment'");

// Delete all product data
$wpdb->query(
    "DELETE FROM {$wpdb->postmeta} WHERE meta_key LIKE '_product_%' OR meta_key LIKE 'attribute_%'",
);

// Delete all product taxonomies
$wpdb->query(
    "DELETE FROM {$wpdb->terms} WHERE taxonomy = 'product_cat' OR taxonomy = 'product_tag'",
);

// Delete all product taxonomy relationships
$wpdb->query(
    "DELETE FROM {$wpdb->term_relationships} WHERE taxonomy = 'product_cat' OR taxonomy = 'product_tag'",
);
