<?php
/**
 * @snippet       Get Current User Country - WooCommerce
 * @author       Claudius A.
 * @compatible    WooCommerce 7
 * @thanks     https://businessbloomer.com/bloomer-armada/
 * @thanks https://stackoverflow.com/questions/51820223/get-the-geo-located-country-and-state-in-woocommerce-3
 */

/**
 * Define action and its functionality.
 */

function ketowp_action()
{
    do_action("ketowp_action");
}

/**
 * Register the action with WordPress.
 */

add_action("ketowp_action", "geolocate_country");

function geolocate_country()
{
    // Geolocation must be enabled in Woo Settings
    // Get an instance of the WC_Geolocation object class
    $geo_instance = new WC_Geolocation();
    // Get geolocated user geo data.
    $user_geodata = $geo_instance->geolocate_ip();

    // Get current user GeoIP Country
    $country = $user_geodata["country"];
    echo '<span class="shipping">Ships to: ' . $country . "</span>";
}
