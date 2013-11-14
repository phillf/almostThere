<?php
/* IMPORT.PHP the finest in functionPacking Technology!
	Code by Charlie Redden AKA LuckyMonkey; luckymonkey AT almost-there DOT org
	For use only on almost-there.org
	Currently under US Copyright, no alterations or public modifications allowed until final version.
	
	What the fuck this document is:
		To give a space for functions and various arrays that will be needed when building pages
		on almost-there.org
		Almost-There has many versions of its website, this shall serve as the final version
		to be built on and will be made to be as future proof and expandable as possible
		to the point of possibly becoming its own CMS and website framework.
	What this document is NOT: Evidence in court (hopefully)
	
	Guidelines: All functions must take into account all other functions when being written
	this is not a strict rule, however allowing the inner workings of the website are consistent
	and work dynamically with each other is a mainstay.
	
	http://forums.steampowered.com/forums/showthread.php?t=1430511
	
*/

// Use this variable with a dummy query string afterCSS/JS documents to prevent caching
$pageSeed=rand(1, 1024);
// colors chooseable in the ColorPicker
$colorPick = array("#EE5078", "#FF8039", "#FFA533", "#FFC233", "#FFE030", "#FFF933", "#D7FF20", "#15FF3E", "#03BCFF", "#00FF7F","#90EE90", "#3CB371", "#00FA9A", "#808000", "#2E8B57", "#FF0000", "#FF4500", "#FF8C00", "#FFA500", "#ED2939","#800000", "#A52A2A", "#D2691E", "#FF7F50", "#DC143C", "#E9967A", "#FF1493", "#B22222", "#FF69B4", "#CD5C5C","#F08080",  "#6495ED", "#008B8B", "#483D8B", "#00BFFF", "#1E90FF", "#ADD8E6", "#20B2AA", "#87CEFA", "#B0C4DE", "#76608A", "#7B68EE", "#4169E1", "#6A5ACD", "#708090","#4682B4", "#008080", "#40E0D0", "#0099CC");

//If a user has a color in the setColor cookie we read it, otherwise use theColor
if (isset($_COOKIE["setColor"])) $theColor=$_COOKIE["setColor"];
else 
	$theColor= "#0099FF";
	$antiColor= "#111111";

//Build ColorPicker
function colorForm() {
	echo "\n<!-- colorPicker() -->";
	global $colorPick;

	echo "<div id='colorPicker'>";
	//Set color clientside with jquery, while saving the cookie to be read on next load with PHP
	foreach ($colorPick as $v) { echo "<a class='changeColor' style='background$v'></a>\n"; };
	echo "\n<br /></div>";
	
echo "\n<!-- /colorPicker() -->"; };


function head() {
	global $pageSeed, $theColor, $antiColor;
	echo "\n<!-- /head() -->";

	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>\n";
	
	//THIS FUCKING SUCKS
	echo " 
		<style>
			.theColor {color:" . $theColor . ";}
			.theLinkColor a:link {color:" . $theColor . ";}
			.switch-input:checked ~ .switch-label {background-color:" . $theColor . ";}
				/* #navBody li a:hover {color:" . $theColor . ";} */
			#navBody li a:hover:after {color:" . $theColor . ";}
			.theLinkColor a:visited {color:" . $theColor . ";} .titleWindow {border: 2px solid " . $theColor . ";} a:hover {color:" . $theColor . ";}
			.theLinkColor a:hover {color:" . $antiColor . ";background-color:" . $theColor . ";}
			.theLinkColor a:active {color:" . $antiColor . ";background-color:" . $theColor . ";}
			.theBGcolor, table th {color:#222222;background-color:" . $theColor . ";}	
			#navBody li:before {color:" . $theColor . ";}
		</style>
		<!-- <link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico'> --> 
		<link rel='stylesheet' type='text/css' href='/new/sty/style.css?rnd=" . $pageSeed . "'>";
			
	echo "
		<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
		<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
		<script src='/new/scr/animations.jquery.js?rnd=" . $pageSeed . "'></script>
		<script src='/new/scr/bubbles.jquery.js?rnd=" . $pageSeed . "'></script>";
	
echo "\n<!-- /head() -->"; };

function preBody() {
	echo "\n<!-- preBody() -->";
	global $pageSeed , $theColor;

	echo "
	<div id='allOfTheThings'>
	<div id='everything'>
		<div id='header' class='theBGcolor'>
			<div class='bubbles' style='z-index:+1;'>
			<!--<a class='bubble-toggle' href='#'>Bubbles Off</a>-->
		</div>
	<img class='logo cf' style='z-index:+2;' width='400' height='50' src='img/logo.png'  alt='Click here to return Home'/><span class='logo'  style='z-index:+2;font-size:12px;opacity:0.6;font-weight:bold;margin-left:60px;'><span class='msg-type' id='msg'>";
		include("quotes.sharky.php"); 
echo "</span></span></div>";
echo "
<div class='cf' id='navBody'> 
	<ul class='animateNav'>
		<li><a href='/new/index.php'>Squares></a></li>
		<li><a href='/forums/'>Forums</a></li>
		<li><a href='/new/fridge.php'>Fridge</a></li>
		<li><a href='steam://url/GroupSteamIDPage/103582791430342520'>Steam</a></li>
		<li><a href='/new/irc.php'>IRC</a></li>
		<li><a href='#servers'>Servers</a></li>
		<li><a href='#users'>Users</a></li>
	</ul>
	<div id='settingsButton'>
		<span>Open Settings</span><span style='color:" . $theColor . "'>&#9881;</span>
	</div>
	<div id='settingsMenu'>";
	echo "<div class='settingsMenuBlock'>";
		colorForm();
	echo "</div>";
	echo "<div class='settingsMenuBlock'>\n<span>Hello " . $_SERVER['REMOTE_ADDR'] . "!</span></div>";
	if (isset($_COOKIE["almostUser"]))
		echo "Welcome " . $_COOKIE["almostUser"] . "!<br>";
	else
		echo "<div class='settingsMenuBlock'><a class='theColor' href='http://www.almost-there.org/forums/misc.php?action=steam_login'>Click here to Login</a></div>";
		echo "<div class='settingsMenuBlock'>";
			$bytes = disk_free_space(".");
			$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
			$base = 1024;
			$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
	echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . ' is available.<br />';
	echo "</div>";
	
	
	
	echo "<div class='settingsMenuBlock'>
					<span class='fl cf'>Fancy animations</span>
					<label class='switch fr'>
					  <input type='checkbox' class='switch-input' checked>
					  <span class='switch-label' data-on='On' data-off='Off'></span>
					  <span class='switch-handle'></span>
					</label><br />
				</div>
				<div class='settingsMenuBlock'>				
					<span class='fl cf'>Show NSFW things?</span>
							<label class='switch fr'>
							  <input type='checkbox' class='switch-input'>
							  <span class='switch-label' data-on='Yes' data-off='No'></span>
							  <span class='switch-handle'></span>
							</label><br />
				</div>
				<div class='settingsMenuBlock'>				
					<span class='fl cf'>Sounds</span>
							<label class='switch fr'>
							  <input type='checkbox' class='switch-input' checked>
							  <span class='switch-label' data-on='On' data-off='Off'></span>
							  <span class='switch-handle'></span>
							</label><br />
				</div>
				<div class='settingsMenuBlock'>
					<span class='fl cf'>Mobile Version</span>
					<label class='switch fr'>
					  <input type='checkbox' class='switch-input'>
					  <span class='switch-label' data-on='On' data-off='Off'></span>
					  <span class='switch-handle'></span>
					</label><br />
				</div>
				<div class='settingsMenuBlock'>				
					<span class='fl cf'>Developer Options</span>
							<label class='switch fr'>
							  <input type='checkbox' class='switch-input'>
							  <span class='switch-label' data-on='On' data-off='Off'></span>
							  <span class='switch-handle'></span>
							</label><br />
				</div>";
	echo "<!-- End of SettingsMenu -->";
echo "\n</div>\n</div>\n<div class='contentBody cf' >";
echo "<!-- preBody function End -->";
}

//This function will be expanded in the future to allow squares to be read from a configuration array
//so they may have multiable sizes, content, backgrounds, ansd elements
function squares( $squareTitle = "squareTitle \not defined!" ) { echo "<div class=' frontBody animateSquare theBGcolor cf'> <h3>" . $squareTitle . "</h3>"; echo "</div>"; }

function displaySource() {
	echo "
	<br /><br /><br /><br />
	<script>
		$(document).ready(function(){
		$(\".shSource\").click(function(){
		$(\".sourceCode\").toggle();
		}); });
	</script>";
	echo "<div  class='sourceCode' >";
		show_source(__FILE__);
	echo "</div>";
};

function postBody() {
echo "\n<!-- /postBody()-->";

//StickyFooter requires two closing div tags
echo "
<br /><br />
			
		</div><!-- content body -->
	</div><!-- everything -->
</div><!-- allOfTheThings -->
<div class='theColor' id='footer'>
	<div class='fl'>Welcome  Guest</div>
	<div class='fr'>&copy; Copyright LOL Almost - There</div>
</div>";
echo "\n<!-- /postBody -->\n";
} 
?>