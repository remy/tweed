# Tweed - Twitter Feeder

Tweed reads from a Twitter search URL and pushes each individual tweet through the plugins that have been specified in the config.yaml.

Tweed has been tested with PHP4 and PHP5, but if you spot any issues, ping me on Twitter [@rem](http://twitter.com/rem) and/or post up the full detail on the GitHub issues - or *even* better, go fork and fix it for us! :-)

## Config settings

Check out the boilerplate config for Tweed.  Most of the options are pretty self explanatory, and the db\_store plugin will automatically create the database table for you if you use it (so change the schema in there - though this should probably be a config elsewhere).

The key is really the cascading plugins.  The order you specify the plugins is the order in which they are used against each tweet.

So if you want to store the tweets, make sure db\_store is the last plugin.

## Plugin design

Drop new plugins in to the plugins directory.  They are classes with a constructor (not required) and a `run` method.

For the tweet to cascade to the next plugin, you must return the tweet, otherwise `return false` (although returning nothing will also do the trick).

### Example plugin

<pre><code>&lt;?php
class dump {
  // tweet is the full single object that returns from a JSON hit to the search API
  function run($tweet) {
    var_dump($tweet);
    
    // maintains the chain of plugins for this tweet
    return $tweet;
  }
}
?&gt;</code></pre>

## Configuration where fopen can't be accessed from cron

You need to set up a cronjob that does a URL hit rather than running from the command line.  You should still protect the directory from reading via the .htaccess file, but you'll need to allow entry to the cron.php file:

deny from all
<Files cron.php>
order allow,deny
allow from all
</Files>
