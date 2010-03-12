<?php
// This example request includes an optional API key which you will need to
// remove or replace with your own key.
// Read more about why it's useful to have an API key.
// The request also includes the userip parameter which provides the end
// user's IP address. Doing so will help distinguish this legitimate
// server-side traffic from traffic which doesn't come from an end-user.
$url = "http://ajax.googleapis.com/ajax/services/search/blogs?v=1.0&"
    . "q=pmid+19638045&key=ABQIAAAA0NoLZe54qmm3IrZh3Pr8XRQgUD3M0xCwTeybjGNTl64FQvo9AxRuhHRvCyohglYFUYv0p2GJeVp2Rg&userip=".$_SERVER['SERVER_ADDR'];

// sendRequest
// note how referer is set manually

$body = file_get_contents($url);

// now, process the JSON string
$json = json_decode($body);
// now have some fun with the results...
print_r($json);
?>
