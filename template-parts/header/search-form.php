<?php if (!defined("ABSPATH")) {
    exit();
} ?>

<form class="search-form" role="search" method="get" action="<?php echo home_url(); ?>">
  <label class="screen-reader-text" for="search-input"><?php _e(
      "Search for:",
      "ketowp",
  ); ?></label>
  <input id="search-input" type="search" placeholder="What are you looking for?" value=""
    name="s" />
  <button aria-label="Click or press enter to search">
    <span class="iconify" data-icon="ri:search-line"></span>
  </button>
</form>