<?php

get_header(); ?>

<?php
if (class_exists("WooCommerce")) { ?>

<section class="product-loop">
  <div class="container grid-1-3">
    <aside class="sidebar filters">
      <div class="sticky-xs top-xs">
        <?php do_action("woocommerce_sidebar"); ?>
      </div>
    </aside>

    <div class="products">
      <div class="product-grid">
        <?php }
get_footer();

