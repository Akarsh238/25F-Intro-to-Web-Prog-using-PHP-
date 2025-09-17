<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
function get_current_weather(string $city, string $country = 'CA'): array {
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "," . urlencode($country) . "&units=metric&appid=" . OWM_API_KEY;
    $resp = file_get_contents($url);
    if ($resp === false) {
        throw new RuntimeException("API request failed.");
    }
    $data = json_decode($resp, true);
    if (!is_array($data)) {
        throw new RuntimeException("Invalid API response.");
    }
    return $data;
}