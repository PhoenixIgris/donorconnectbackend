<?php

namespace App\Services;

class Helper
{
 function searchCommons($keyword)
    {
        $url = "https://commons.wikimedia.org/w/api.php?action=query&list=search&format=json&srsearch=" . urlencode($keyword) . "&srlimit=1&srnamespace=6";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if (isset($data['query']['search'][0])) {
            return "https://commons.wikimedia.org/wiki/File:" . $data['query']['search'][0]['title'];
        } else {
            return "https://cdn.aarp.net/content/dam/aarp/home-and-family/your-home/2022/01/1140-box-of-items-for-donations.jpg"; // Provide a default image URL if no image is found
        }
    }
}
