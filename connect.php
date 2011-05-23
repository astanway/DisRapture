<?php

/**
 * @file
 * Check if consumer token is set and if so send user to get a request token.
 */

/**
 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
 */
// require_once('config.php');
// if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
//   echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://twitter.com/apps">https://twitter.com/apps</a>';
//   exit;
// }

session_start();
session_destroy();

echo "<html>";
echo "<div id='content'>";
/* Build an image link to start the redirect process. */
$content = '<a href="./redirect.php"><img src="./images/lighter.png" alt="Sign in with Twitter"/></a>';
echo $content; 
/* Include HTML to display on the page. */
// include('html.inc');
?>
	</div>
	</html>
	<style type="text/css">
	html {
	        background: url(sky.jpg) no-repeat center center fixed;
	        -webkit-background-size: cover;
	        -moz-background-size: cover;
	        -o-background-size: cover;
	        background-size: cover;
			text-align: center;
	}

	#content{
		position: relative;
		margin: 0 auto;
		padding-top: 7em;
	}
	</style>
