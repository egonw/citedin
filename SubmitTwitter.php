<?php
require 'tweet.php';

$tweet = $_GET["tweet"];
$retarr = post_tweet(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET,
                           $tweet, $access_token, $access_token_secret,
                           true, true);
?>