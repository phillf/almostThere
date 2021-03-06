//Genisis
$(function() {


var button = $('.changeColor');
var color;

button.click(function(){
	color = $(this).css("background-color");
    
    $(".theBGcolor").animate({backgroundColor: color},500);
	$(".theColor").animate({color: color},500);
    
    $.cookie('setColor', color, { expires: 365, path: '/' });
});

if(typeof($.cookie('setColor')) != "undefined"){
    color = $.cookie('setColor');
    $(".theColor theBGcolor").css("background-color", color);
}




//How animations should work...

// Two functions will exist, animations to play every time a page is loaded
// And a function to play animations only once when the page is first loaded
 
 
 //http://jsfiddle.net/gmDRM/351/
 
	
$.gl = {};
$.gl.intervalID = -1;
$.gl.countDown = 6.00;
$.gl.beat = 0.00;
$.gl.step = 1.00;
$.gl.div = null;
$.gl.orig = null; // char array
                
function randomLetter(){
  return String.fromCharCode(Math.floor(((Math.random() * 1000) % 73) + 49));
}
function unscramble(__id){
    if ($.gl.intervalID == -1){
        $.gl.countDown = 6.00;
        $.gl.beat = 0.00;
        $.gl.step = 0.00;
        $.gl.div = $(__id);
        $.gl.intervalID = window.setInterval(unscramblechar,1);
    }else{
        window.clearInterval($.gl.intervalID);
        $.gl.intervalID = -1;
    }
}
function unscramblechar(){
    var spans = $('span', $($.gl.div));
    $.gl.countDown -= 0.1;
    $.gl.step += 0.1;
    $.gl.beat += 0.1;
    var charIndex = Math.floor(((Math.random() * 1000) * 1000) % $.gl.orig.length);

    if ($.gl.countDown <= 0){ 
        window.clearInterval($.gl.intervalID); 
        $.gl.intervalID = -1;
        // fill in correct letters
        for(var i = 0; i < spans.length; i++) {
            $(spans[i]).text($.gl.orig[i]);
        }
    }
    
    if ($.gl.beat >= 0.01) { 
        // fill with random chars
        var ch = $(spans[charIndex]).text();
        if (ch != '' && ch != $.gl.orig[charIndex]) {
            $(spans[charIndex]).text(randomLetter()); 
        }                    
        $.gl.beat = 0.00;
    }

    if ($.gl.step >= 0.08) {
        // fill with correct char
        var ch = $(spans[charIndex]).text();
        if (ch != '' && ch != $.gl.orig[charIndex]) {
            $(spans[charIndex]).text($.gl.orig[charIndex]); 
        }                                
        $.gl.step = 0.00;
    }
}                
                
$(document).ready(function () {
    $.gl.orig = $('#msg').text().split('');                    
    $('#msg').empty();
    for(var i = 0; i < $.gl.orig.length; i++) {
        if ($.gl.orig[i] != ' ') {
            $('#msg').append('<span>' + randomLetter() + '</span>');        
        } else {
            $('#msg').append('<span> </span>');        
        }
    } 
    unscramble('#msg');
});
	
	
	
	
	
 /*
var MyDiv1 = document.getElementById('second-text');
var MyDiv2 = document.getElementById('first-text');

	window.ingredients = [ MyDiv2.innerHTML, MyDiv1.innerHTML];
//    var debug = $("#debug");    
    function flipText(newText) {
        flipUp == true ? ($("#second-text").text(newText), $("#first-text").hide("drop", {
            direction: "down"
        }, 300), $("#second-text").show("drop", {
            direction: "up"
        }, 300)) : ($("#first-text").text(newText), $("#first-text").show("drop", {
            direction: "up"
        }, 300), $("#second-text").hide("drop", {
            direction: "down"
        }, 300));
        flipUp = !flipUp; // Alternating flipping direction
    }

	
    var interval = 2e3; // 2 seconds
    var flipUp = true;
    var index = 0;
    var maxIndex = window.ingredients.length - 1;
    setInterval(function() {
        var nextText = window.ingredients[index];
//        debug.append("<p>"+window.ingredients[index]+"</p>");
        flipText(nextText);
        index = (index == maxIndex) ? 0 : index + 1;
     }, interval);
	*/
	$("#settingsButton").click(function() {
		$("#settingsMenu").toggleClass( "hover" );
		$("#settingsMenu").slideToggle( 250 );
		$("#settingsSpan").html("Close Settings");
	});
	
	$(".todoButton").click(function() {
		$(".todoWindow").toggleClass( "hover" );
		$(".todoWindow").slideToggle( 250 );
	});
	
	setTimeout(waitForDoc, 200);
	function waitForDoc() {
		var i = -1;
		var arr = $(".animateNav");
		(function(){
		if(arr[++i])
			$(arr[i]).fadeIn ( 100 ).animate( 150, "linear", arguments.callee);
		})();
	}
	
	setTimeout(waitForDoc, 200);
	function waitForDoc() {
		var i = -1;
		var arr = $(".animateSquare");
		(function(){
		if(arr[++i])
			$(arr[i]).delay ( 100 ).animate({ height: "175px" }, 50, "linear", arguments.callee);
		})();
	}

	// when the DOM is ready...
var tickerIterations = 0;
var currentTickerIteration = 0;
$(document).ready(function () {
  // load the ticker
	createTicker();

}); 

function createTicker(){
	if (typeof $('#ticker-area').attr('alt') != 'undefined'){
		tickerIterations = $('#ticker-area').attr('alt');
	}
	// put all list elements within #ticker-area into array
	var tickerLIs = $("#ticker-area ul").children();
	tickerItems = new Array();
	tickerLIs.each(function(el) {
		tickerItems.push( jQuery(this).html() );
	});
	i = 0
	rotateTicker();
}

function rotateTicker(){
	if( i == tickerItems.length ){
	  i = 0;
		if( tickerIterations > 0 ){
			console.log( "tickerIterations: " +tickerIterations );
			currentTickerIteration++;
			console.log( "currentTickerIteration: " + currentTickerIteration );
			if( currentTickerIteration >= tickerIterations ){
				console.log( "Done iterating" );
				return false;
			}
		}
	}
  tickerText = tickerItems[i];
	c = 0;
	typetext();
	setTimeout( "rotateTicker()", 5000 );
	i++;
}

var isInTag = false;
function typetext() {	
	var thisChar = tickerText.substr(c, 1);
	if( thisChar == '<' ){ isInTag = true; }
	if( thisChar == '>' ){ isInTag = false; }
	$('#ticker-area').html("&nbsp;" + tickerText.substr(0, c++));
	if(c < tickerText.length+1)
		if( isInTag ){
			typetext();
		}else{
			setTimeout("typetext()", 28);
		}
	else {
		c = 1;
		tickerText = "";
	}	
}
	
	
	
	
	
	
	})