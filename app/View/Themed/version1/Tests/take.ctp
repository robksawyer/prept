<?php
//http://slidesjs.com/
//echo $this->Html->css('testing-page');
//echo $this->Html->script('slides.min.jquery',array('inline'=>false));
echo $this->Html->script('jquery.quickflip.min',array('inline'=>false)); //http://dev.jonraasch.com/quickflip/docs
//echo $this->Html->script('jquery.ba-hashchange.min',array('inline'=>false)); //http://benalman.com/projects/jquery-hashchange-plugin/
echo $this->Html->script('jquery.ba-bbq.min',array('inline'=>false)); //https://github.com/cowboy/jquery-bbq/
?>
<div class="stacks test">
	<?php
	if(!empty($this->request->params['pass'][1])){
		$test_type = $this->request->params['pass'][1];
	}
	
	if(count($stack['Card']) < 1):
	?>
	<div class="no-cards">
		<p>This stack doesn't contain any cards. But, you can add some cards by navigating to the <?php echo $this->Html->link('add card',array('controller'=>'stacks','action'=>'add',$stack['Stack']['id'])); ?> page.</p>
	</div>
	<?php
	else:
		if(empty($test_type)):
	?>
		<div class="panel1">
			<p>Do you want to start your test with the terms or the definitions?</p>
			<?php echo $this->Html->link('Terms',array('action'=>'take',$stack['Stack']['id'],'terms'),array()).' or '.$this->Html->link('Definitions',array('action'=>'take',$stack['Stack']['id'],'definitions'),array()); ?>
		</div>
<?php else: ?>
	<div class="card-container" id="card-container-0">
		<div class="slides-container">
			<?php 
				$counter = 0;
				$next = false;
				foreach($stack['Card'] as $card){
					if($counter > 0) $next = true;
					echo $this->element('test-card',array('cache'=>false,
																		'data'=>$card,
																		'stack'=>$stack,
																		'counter'=>$counter,
																		'test_type'=>$test_type,
																		'next'=>$next
																		)
																	);
					$counter++;
				}
			?>
		</div>
		<div class="clear"></div>
		<div class="slide-navigation">
			<div class="left-arrow">
				<?php echo $this->Html->link($this->Html->image('../img/slide-show/arrow_left.gif',array('border'=>false)),'#',array('escape'=>false)); ?>
			</div>
			<div class="right-arrow">
				<?php echo $this->Html->link($this->Html->image('../img/slide-show/arrow_right.gif',array('border'=>false)),'#',array('escape'=>false)); ?>
			</div>
		</div>
	</div>
	<?php 
		endif;
	endif; ?>
</div>
<script type="text/javascript">
	var maxCards = <?php echo count($stack['Card'])-1; ?>;
	var curCard = 0;
	var cardWidth = 0;
	var rightArrowActivated = false;
	var leftArrowActivated = false;
	
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
		$('.card-container .slides-container #test-card-'+curCard).fadeTo(300,0.5,addNext); //Fade out previous card
		curCard -= 1;
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
		$('.card-container .slides-container #test-card-'+curCard).fadeTo(300,0.5,addNext); //Fade out previous card
		curCard += 1;
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
</script>