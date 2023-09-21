<?php
if (!defined("ABSPATH")) {
	exit();
}

function cat_list()
{
	$categories = get_the_category();
	if ($categories) {
		$html = '<ul class="cat__wrapper list-off" aria-label="categories">';

		foreach ($categories as $category) {
			$category_link = get_category_link($category->term_id);
			$category_name = $category->name;

			$html .=
				'<li><a href="' .
				esc_url($category_link) .
				'" aria-label="Read more ' .
				esc_attr($category_name) .
				' posts">' .
				esc_html($category_name) .
				"</a></li>";
		}

		$html .= "</ul>";
		return $html;
	}
}
