<?php
class tweetcc {
    var $url = 'http://tweetcc.com/api/tweetcc.json.php';
    
    function run($tweet) {
        $cc = json_decode(file_get_contents($this->url . '?username=' . $tweet->from_user));
        
        $tweet->tweet_cc = $cc[$tweet->from_user];
        
        return $tweet;
    }
}

?>