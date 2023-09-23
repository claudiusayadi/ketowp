<?php

function cwpai_woo_check_duplicate_upc_ean_mfg_pn()
{
    $args = [
        "post_type" => "product",
        "posts_per_page" => -1,
        "post_status" => "publish",
        "meta_query" => [
            "relation" => "OR",
            [
                "key" => "upc_ean",
                "compare" => "EXISTS",
            ],
            [
                "key" => "mfg_pn",
                "compare" => "EXISTS",
            ],
        ],
    ];
    $query = new WP_Query($args);
    $duplicate_ids = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $upc_ean = get_post_meta(get_the_ID(), "upc_ean", true);
            $mfg_pn = get_post_meta(get_the_ID(), "mfg_pn", true);
            $args = [
                "post_type" => "product",
                "posts_per_page" => -1,
                "post_status" => "publish",
                "meta_query" => [
                    "relation" => "OR",
                    [
                        "key" => "upc_ean",
                        "value" => $upc_ean,
                        "compare" => "=",
                    ],
                    [
                        "key" => "mfg_pn",
                        "value" => $mfg_pn,
                        "compare" => "=",
                    ],
                ],
            ];
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $duplicate_ids[] = get_the_ID();
                }
            }
        }
    }
    wp_reset_postdata();
    $duplicate_ids = array_unique($duplicate_ids);
    return implode(",", $duplicate_ids);
}
?>
