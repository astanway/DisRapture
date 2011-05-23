<?php 
	session_start();
	require_once('twitteroauth/twitteroauth.php');
	require_once('config.php');

	/* If access tokens are not available redirect to connect page. */
	if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
	    header('Location: ./clearsessions.php');
	}
	
	if(isset($_POST['date'])){
	/* Get user access tokens out of the session. */
	$access_token = $_SESSION['access_token'];

	/* Create a TwitterOauth object with consumer/user tokens. */
	$connection = new TwitterOAuth('8kUCW7Fn0M8vfY4OpULg', 'TtNFQwBqbsghV94GKDbzRkkxh3PEcOgXXf4wQcNSw', $access_token['oauth_token'], $access_token['oauth_token_secret']);

	/* If method is set change API call made. Test is called by default. */
	$content = $connection->get('friends/ids');
	$array = implode(",", $content);
	$content = $connection->get('users/lookup', array('user_id' => $array));
	// print_r($content);
	
	//convert to unix epoch
	$date = $_POST['date'];
	$date = strtotime($date);
	
	$heaven = array();
	$hell = array();
	
	//filter out posts after date
	foreach($content as $person){
		$time = $person->status->created_at;
		$unix = strtotime($time);
		
		//populate heaven and hell
		if($unix < $date){
			array_push($heaven, $person->screen_name);
		} else {
			array_push($hell, $person->screen_name);
		}
	}
	
	?>
	
	<style type="text/css">
	#rapture{
	margin: 0;
	padding: 0;
	height: 100%;
	width: 100%;
	}
	
	#heaven{
		position: relative;
		top:49px;
		left: 158px;
		font-family: Helvetica;
		font-size: 2.5em;
		font-weight: bold;
	}
	
	#hell{
		position: relative;
		font-family: Helvetica;
		font-size: 2.5em;
		font-weight: bold;
		top: 413;
		left: 40;
		padding-right: 5em;
	}
	
	html, body{
		margin: 0;
		padding: 0;
		height: 100%;
		width:100%;
	}
	
	body {
		background: url('rapture.png') no-repeat center center fixed;
	        -webkit-background-size: cover;
	        -moz-background-size: cover;
	        -o-background-size: cover;
	        background-size: cover;	
	}
	
	#jc{
		position: fixed;
		top: 7px;
		left: 10px;
		z-index: 20;
	}
	
	#s{
		position: fixed;
		bottom: 0px;
		right: 0px;
	}
	
	
	</style>
	
	<?php
	echo "<!doctype html>";
	echo "<html>";
	echo "<div id='rapture'>";
		echo "<img id='jc' src='jesus.png'</img>";
		echo "<div id='heaven'>";
			echo "<div id='heaven-top'>";
			$i=0;
			for($i=0; $i < (sizeOf($heaven)/2); $i++){
				echo $heaven[$i]; 
				echo "&nbsp;&nbsp;&nbsp;";
				}
			
			echo "</div>";
			echo "<br>";
	
			echo "<div id='heaven-bottom'>";
			for($i; $i< sizeOf($heaven); $i++){
				echo $heaven[$i]; 
				echo "&nbsp;&nbsp;&nbsp;";
				}		
			echo "</div>";
			
		echo "</div>";
		
		echo "<div id='hell'>";
		echo "<div id='hell-top'>";
		$i=0;
		for($i=0; $i < (sizeOf($hell)/2); $i++){
			echo $hell[$i]; 
			echo "&nbsp;&nbsp;&nbsp;";
			}
		
		echo "</div>";
		echo "<br>";

		echo "<div id='hell-bottom'>";
		for($i; $i< sizeOf($hell); $i++){
			echo $hell[$i]; 
			echo "&nbsp;&nbsp;&nbsp;";
			}
			
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "</div>";
		
			echo "</div>";

		echo "</div>"; //main, i think
	echo "</div>";
			echo "<img id='s' src='satan.png'</img>";
	echo "</html>";
	die;
}
?>

<link href='http://fonts.googleapis.com/css?family=Ultra' rel='stylesheet' type='text/css'>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
 <script>
  $(document).ready(function() {
    $("#datepicker").datepicker({ dateFormat: 'MM d, yy', width:800 });
	$("#datepicker").click(function() {
		$("input[type=submit]").show();
	});
  });
  </script>

<style type="text/css">

.ui-datepicker{
	width: 412px;
}
.field{
    height: 69px; width: 420px;
    font-size: 40px;
    border: 3px #b0bac9 solid;
    border-radius: 5px;
    color: #7385a0;
	padding: 5px;
	margin-top: .5em;
	text-align: center;
}

#title{
	background-color: #FFF;
	font-size:.4em;
	padding: 10px;
	font-weight: bold;
	margin-top: 1em;
	font-family: Helvetica;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}

#form{
    font-family: helvetica;
	margin-left: auto;
	margin-right: auto;
	width: 100%;
	text-align: center;
}

#content{
	margin-left: auto;
	margin-right: auto;
	width: 100%;
/*	overflow: hidden;*/
}

#target{
	position: relative;
	overflow: hidden;
	top: -305px;
	width: 300px;
	left: 340px;
	z-index: 5;
	font-size: 2em;
	text-align: center;
	font-family: "Just Another Hand";
}
html {
        background: url(sky.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
}

#prompt{
	font-size: 4em;
	text-align: center;
	font-family: Ultra;
}
</style>
<html>
<div id="content">
<form id="form" class="form_1" method="post" action="index.php">
<span id="prompt">When was the last rapture?<span><br>
	<input type="text" class="field" id="datepicker" name="date"></input><br>
<input id="title" type="submit" style="display: none;"></input>
</form>
</div>
</html>
