<?php

if (!defined("ABSPATH")) {
	exit();
}

/* DEFAULT "ALT" FOR AVATARS */
add_filter("pre_get_avatar_data", function ($atts) {
	if (empty($atts["alt"])) {
		if (have_comments()) {
			$author = get_comment_author();
		} else {
			$author = get_the_author_meta("display_name");
		}
		$alt = sprintf("Avatar for %s", $author);

		$atts["alt"] = $alt;
	}
	return $atts;
});
