<?php
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options

//$url = "http://api.snooth.com/wines/?";

$searchme = $_GET['q'];

$url = "http://api.snooth.com/wines/?akey=rrwb6nqmqmiyhshx0rickn01sn3aoi89f78ym08rhuhbbsz7&ip=192.0.43.10&q=".$searchme;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);


?>
