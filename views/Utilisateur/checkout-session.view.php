<?php

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LRa8pKkKE3X1OTVZggUnEYTv7oMk9Ep5g9X8UWtgiZTlOZlGY5wtdNXBuWeIiHpf0pCgylBgtOZlswp60vMAvO400u1zFyXs7');

header('Content-Type: application/json');



$line_items = array();
foreach ($create_checkout as $item) {
    $temp_items = array(
        "price_data" => [
            "currency" => "eur",
            "product_data" => [
                "name" => $item['nom'] . " " . $item['taille'] . " " . $item['couleur'],
            ],
            "unit_amount" => ($item['promotion'] != 0 && $item['promotion'] < $item['prix'] && $item['prix'] > 0) ? $item['promotion'] * 100 : $item['prix'] * 100,
            'tax_behavior' => 'exclusive',
        ],
        'quantity' => 1,

    );
    array_push($line_items, $temp_items);
}

$shipping_rate = \Stripe\ShippingRate::create([
    'display_name' => 'Ground shipping',
    'type' => 'fixed_amount',
    'fixed_amount' => [
      'amount' => 500,
      'currency' => 'usd',
    ],
    'delivery_estimate' => [
      'minimum' => [
        'unit' => 'business_day',
        'value' => 5,
      ],
      'maximum' => [
        'unit' => 'business_day',
        'value' => 7,
      ],
    ],
  ]);

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[$line_items]],
    'mode' => 'payment',

    'success_url' => 'http://localhost/dwwm/boutique/succesPaiement',
    'cancel_url' => 'http://localhost/dwwm/boutique/commande',
    'automatic_tax' => [
        'enabled' => true,
    ],
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
