<?php


require('../wp-kitcurl.php');


Echo "Hello";


$_ = new Kit\IO\HTTP\KitCurl();

$t =  $_ -> new_http_rawget("http://mylibraries.webapp.soap/wp-kitcurl/README.md");



print_r($t->execute());