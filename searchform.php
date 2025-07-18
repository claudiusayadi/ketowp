<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package Adun_Studio
 * @subpackage KetoWP
 * @since KetoWP 1.0
 */
?>

<form class="search-form w-full max-w-lg inline-block relative" role="search" method="get" action="<?php echo esc_url(
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
  <input id="search-input" type="search" class="px-4 w-full border border-gray-300 rounded-lg relative min-h-[2.5em]" placeholder="<?php echo esc_attr_x(
      "What are you looking for?",
      "placeholder",
      "ketowp",
  ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

  <button type="submit" class="px-4 bg-transparent rounded-sm absolute top-0 right-0 min-h-[2.5em] hover:bg-action-50" aria-label="Search"><span class="screen-reader-text">
      /* translators: Hidden accessibility text.*/
      <?php echo _x("Search", "submit button", "ketowp"); ?>
    </span>
    <span class="iconify text-xl" data-icon="ri:search-line"></span>
  </button>
</form>