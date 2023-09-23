<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */
?>

<form class="search-form" role="search" method="get" action="<?php echo esc_url(
    home_url("/"),
); ?>">
  <label for="search-input">
    <span class="screen-reader-text">
      /* translators: Hidden accessibility text. */<?php echo _x(
          "Search &hellip",
          "label",
          "ketowp",
      ); ?>
    </span>
  </label>
  <input id="search-input" type="search" placeholder="<?php echo esc_attr_x(
      "What are you looking for?",
      "placeholder",
      "ketowp",
  ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

  <button type="submit" aria-label="Search"><span class="screen-reader-text">
      /* translators: Hidden accessibility text.*/
      <?php echo _x("Search", "submit button", "ketowp"); ?>
    </span>
    <span class="iconify" data-icon="ri:search-line"></span>
  </button>
</form>