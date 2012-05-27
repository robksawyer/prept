var maxCards = 0;
var curCard = 0;
var cardWidth = 0;
var rightArrowActivated = false;
var leftArrowActivated = false;
var scoreCard = false;

//Timer Variables
var timers = new Array(); //Holds the timers for each card
var timer_int;

$(document).ready(function() {
	//Activate card action rollovers
	$(".test-card-actions img").hover(function() { 
		this.src = this.src.replace("_off", "_on");
	},function() { 
		this.src = this.src.replace("_on", "_off");
	});
	
	cardWidth = $('.card-container .slides-container .test-card').width();
	//Deactivate left arrow
	deactivateLeftArrow();
	activateRightArrow();
	//Start the timer on the current card
	start_timer(curCard);
	
	//TODO: 
	//Generate a form of checkboxes that track the user right and wrong answers
	//Generate a hidden input named time_elapsed to track the time on each card
	
	//Card Flipping
	//http://dev.jonraasch.com/quickflip/docs
	$('div.slides-container div.test-card div.quickflip-wrapper').quickFlip();
	
	/*$('div.stacks.test div.quickflip-wrapper').each(function(ev){
		var cardURL = $(this).find('a.front').attr('href');
		//Bind the click to the card
		$(this).click(function(){
			window.location.href = cardURL.toString();
		});
		
		$(this).click(function(){
			//on
			$(this).quickFlipper();
		},function(){
			//off
			$(this).quickFlipper();
		});
	});*/
	
	//Make the text fit
	$('div.slides-container div.test-card .card-data').each(function(){
		var maxFontSize = 24;
		var widthToFit = $('div.slides-container div.test-card').width() - (15*4); //15 = padding around each side
		var textWidth = 0;
		//http://stackoverflow.com/questions/9404536/finding-text-width-in-jquery
		$(this).clone().addClass("checkWidth").appendTo("body").css({"float": "left"});
		textWidth = $(".checkWidth").width();
		$('.checkWidth').remove();
		if(textWidth > widthToFit){
			$(this).fitText(1, { minFontSize: '10px', maxFontSize: '24px' });
		}
	});
	/*$('div.stacks.test div.test-card div.test-card-data a.back').each(function(){
		var maxFontSize = 24;
		var widthToFit = $('div.stacks.test div.test-card').width() - (15*4); //15 = padding around each side
		var textWidth = 0;
		//http://stackoverflow.com/questions/9404536/finding-text-width-in-jquery
		$(this).clone().addClass("checkWidth").appendTo("body").css({"float": "left"});
		textWidth = $(".checkWidth").width();
		$('.checkWidth').remove();
		if(textWidth > widthToFit){
			$(this).fitText(1, { minFontSize: '10px', maxFontSize: '24px' });
		}
	});*/
});

/**
* Starts the card timer
* @param id The id of the div.card to target.
*/ 
function start_timer(id){
	//Tested is turned to true when the user tests their knowledge on the card. After it flips. 
	if(!timers[id]){
		timer_int = setInterval("timer("+id+")",1000); //1000 will  run it every 1 second
	}else{
		if(!timers[id]['tested']){
			timer_int = setInterval("timer("+id+")",1000); //1000 will  run it every 1 second
		}
	}
	return;
}

/**
* Stops the card timer
* @param id The id of the div.card to target.
*/
function stop_timer(id){
	clearInterval(timer_int);
	//counter ended, do something here
	return;
}

/**
* Cancels the timer and keeps it from starting back up when switching between the cards
* @param id The id of the div.card to target.
*/
function cancel_timer(id){
	timers[id]['tested'] = true;
	clearInterval(timer_int);
	//counter ended, do something here
	return;
}

/**
* The timer brain
* @param id The id of the div.card to target.
*/
function timer(id) {
	if(timers[id] == undefined){
		timers[id] = new Array();
		timers[id]['secs'] = 0;
		timers[id]['mins'] = 0;
		timers[id]['hours'] = 0;
		timers[id]['tested'] = false;
	}
	
	timers[id]['secs'] = timers[id]['secs'] + 1;
	if(timers[id]['secs'] == 60){
		timers[id]['secs'] = 0;
		timers[id]['mins'] = timers[id]['mins'] + 1;
	}
	if(timers[id]['mins'] == 60){
		timers[id]['mins'] = 0;
		timers[id]['hours'] = timers[id]['hours'] + 1;
	}
	document.getElementById("timer-"+id).innerHTML = pad2(timers[id]['hours'])+":"+pad2(timers[id]['mins'])+":"+pad2(timers[id]['secs']);
}

/** 
* Pads a number with two digits.
*/ 
function pad2(number) {
	return (number < 10 ? '0' : '') + number;
}

function deactivateLeftArrow(){
	leftArrowActivated = false;
	$('.card-container .slide-navigation .left-arrow').addClass('disabled');
	$('.card-container .slide-navigation .left-arrow').off("click",left_arrow_click);
}

function activateLeftArrow(){
	leftArrowActivated = true;
	$('.card-container .slide-navigation .left-arrow').on('click',left_arrow_click);
	if($('.card-container .slide-navigation .left-arrow').hasClass('disabled')){
		$('.card-container .slide-navigation .left-arrow').removeClass('disabled');
	}
}

function deactivateRightArrow(){
	rightArrowActivated = false;
	$('.card-container .slide-navigation .right-arrow').addClass('disabled');
	$('.card-container .slide-navigation .right-arrow').off('click',right_arrow_click);
}

function activateRightArrow(){
	rightArrowActivated = true;
	$('.card-container .slide-navigation .right-arrow').on('click',right_arrow_click);
	if($('.card-container .slide-navigation .right-arrow').hasClass('disabled')){
		$('.card-container .slide-navigation .right-arrow').removeClass('disabled');
	}
}

/*
	Handles the acfion items when the left arrow is clicked
*/
function left_arrow_click(event){
	event.preventDefault();
	stop_timer(curCard); //Stop the timer on the card
	if(curCard == (maxCards-1)){
		scoreCard = true;
	}else{
		scoreCard = false;
	}
	$('.card-container .slides-container #test-card-'+curCard).fadeTo(300,0.5,addNext); //Fade out previous card
	curCard -= 1;
	
	if(!scoreCard){
		start_timer(curCard); //Start the timer on the next card
	}
	
	$('.card-container .slides-container #test-card-'+curCard).fadeTo(300,1,removeNext); //Fade in new card
	//Move the slides-container left an amount based on the card width
	$('.card-container .slides-container').animate({'marginLeft':'+='+cardWidth+"px"});
	
	if(curCard <= maxCards && !rightArrowActivated){
		activateRightArrow();
	}
	if(curCard == 0 && leftArrowActivated){
		deactivateLeftArrow();
	}
}

/*
	Handles the action items when the right arrow is clicked
*/
function right_arrow_click(event){
	event.preventDefault();
	stop_timer(curCard); //Stop the timer on the card
	if(curCard == (maxCards-1)){
		scoreCard = true;
	}else{
		scoreCard = false;
	}
	
	$('.card-container .slides-container #test-card-'+curCard).fadeTo(300,0.5,addNext); //Fade out previous card
	curCard += 1;
	
	if(!scoreCard){
		start_timer(curCard); //Start the timer on the next card
	}
	
	$('.card-container .slides-container #test-card-'+curCard).fadeTo (300,1,removeNext); //Fade in new card
	//Move the slides-container left an amount based on the card width
	$('.card-container .slides-container').animate({'marginLeft':'-='+cardWidth+"px"});
	
	if(curCard > 0 && !leftArrowActivated){
		activateLeftArrow();
	}
	if(curCard >= maxCards && rightArrowActivated){
		deactivateRightArrow();
	}
}

function shuffleCards(){
	$(".card-container .slides-container").randomize("div.test-card");
}

/*
	1. Stop the card timer
	2. Flip the card
	3. Show the answer
	4. Request whether or not the user guessed the correct answer
*/
function doTest(id){
	$('div.slides-container div#test-card-'+id+' div.quickflip-wrapper').quickFlipper();
	setElapsedTime(id);
	cancel_timer(id); //Cancel the timer so that it doesn't start back up
}

/**
* Sets the elapsed time of the card
*/
function setElapsedTime(id){
	$('.grade #Question'+id+'TimeElapsed').val($('#timer-'+id).text());
}

function flipBackAround(id){
	$('div.slides-container div#test-card-'+id+' div.quickflip-wrapper').quickFlipper();
}

function addNext(){
	if(!$(this).hasClass('next')){
		$(this).addClass('next');
	}
}
function removeNext(){
	if($(this).hasClass('next')){
		$(this).removeClass('next');
	}
}

(function($) {
	$.fn.randomize = function(childElem) {
	  return this.each(function() {
			var $this = $(this);
			var elems = $this.children(childElem);
			var curNext;
			elems.sort(function() { return (Math.round(Math.random())-0.5); });
			$this.remove(childElem);
			for(var i=0; i < elems.length; i++){
				//Get the id and change it to the i val
				var elementValues = $(elems[i]).attr('id').split('-');
				var elementID = elementValues[2];
				if($(elems[i]).hasClass('next')){
					curNext = $(elems[i]).attr('id');
					$(elems[i]).removeClass('next');
				}
				$(elems[i]).fadeTo(10,1);
				$(elems[i]).attr('id','test-card-'+i);
				$this.append(elems[i]);
			}
			//Add the next class to the div # that used to have it.
			$("#"+curNext).fadeTo(10,0.5);
			$("#"+curNext).addClass('next');
	  });
	}
})(jQuery);