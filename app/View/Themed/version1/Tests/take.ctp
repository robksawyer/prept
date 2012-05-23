<?php
//http://slidesjs.com/
//echo $this->Html->css('testing-page');
//echo $this->Html->script('slides.min.jquery',array('inline'=>false));
echo $this->Html->script('jquery.quickflip.min.js',array('inline'=>false)); //http://dev.jonraasch.com/quickflip/docs
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
			<?php echo $this->Html->link('Terms',array('action'=>'test',$stack['Stack']['id'],'terms'),array()).' or '.$this->Html->link('Definitions',array('action'=>'test',$stack['Stack']['id'],'definitions'),array()); ?>
		</div>
<?php else: ?>
	<div class="card-container" id="card-container-0">
		<div class="slides_container">
			<?php 
				$counter = 0;
				$next = false;
				foreach($stack['Card'] as $card){
					if($counter > 0) $next = true;
					echo $this->element('test-card',array('cache'=>false,'data'=>$card,'counter'=>$counter,'test_type'=>$test_type,'next'=>$next));
					echo "<ul class='test-card-actions'>";
					echo "<li>".$this->Html->link($this->Html->image('../img/slide-show/icons/question-icon-52x52_off.png',array('border'=>false)),'#',array('escape'=>false,'title'=>'Question?'))."</li>";
					echo "<li>".$this->Html->link($this->Html->image('../img/slide-show/icons/add-card-icon-52x52_off.png',array('border'=>false)),array('controller'=>'cards','action'=>'add',$stack['Stack']['id']),array('escape'=>false,'title'=>'Add a Card'))."</li>";
					echo "<li>".$this->Html->link($this->Html->image('../img/slide-show/icons/delete-card-icon-52x52_off.png',array('border'=>false)),array('controller'=>'cards','action'=>'add',$stack['Stack']['id'],null,__('Are you sure you want to delete # %s?', $card['id'])),array('escape'=>false,'title'=>'Delete a Card'))."</li>";
					echo "<li>".$this->Html->link($this->Html->image('../img/slide-show/icons/shuffle-icon-52x52_off.png',array('border'=>false)),'javascript:shuffleCards();',array('escape'=>false,'title'=>'Shuffle Cards'))."</li>";
					echo "<li>".$this->Html->link($this->Html->image('../img/slide-show/icons/share-icon-52x52_off.png',array('border'=>false)),'#',array('escape'=>false,'title'=>'Share'))."</li>";
					echo "<li>".$this->Html->link($this->Html->image('../img/slide-show/icons/take-test-icon-52x52_off.png',array('border'=>false)),'#',array('escape'=>false,'title'=>'Take Test'))."</li>";
					echo "</ul>";
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
	$(document).ready(function() {
		//Activate card action rollovers
		$(".test-card-actions img").hover(function() { 
			this.src = this.src.replace("_off", "_on");
		},function() { 
			this.src = this.src.replace("_on", "_off");
		});
		
		var cardWidth = $('.card-container .slides_container .test-card').width() + ($("ul.test-card-actions").width()*2);
		var curCard = 0;
		
		$('.card-container .slide-navigation .right-arrow').click(function(event){
			event.preventDefault();
			$('.card-container .slides_container #test-card-'+curCard).fadeTo(300,0.5); //Fade out previous card
			curCard += 1;
			$('.card-container .slides_container #test-card-'+curCard).fadeTo (300,1); //Fade in new card
			//Move the slides_container left an amount based on the card width
			$('.card-container .slides_container').animate({'marginLeft':'-='+cardWidth+"px"});
		});
		
		$('.card-container .slide-navigation .left-arrow').click(function(event){
			event.preventDefault();
			$('.card-container .slides_container #test-card-'+curCard).fadeTo(300,0.5); //Fade out previous card
			curCard -= 1;
			$('.card-container .slides_container #test-card-'+curCard).fadeTo(300,1); //Fade in new card
			//Move the slides_container left an amount based on the card width
			$('.card-container .slides_container').animate({'marginLeft':'+='+cardWidth+"px"});
		});
		
		//TODO: 
		//Generate a form of checkboxes that track the user right and wrong answers
		//Generate a hidden input named time_elapsed to track the time on each card
		
		//Card Flipping
		//http://dev.jonraasch.com/quickflip/docs
		/*$('div.stacks.test div.quickflip-wrapper').quickFlip();
		$('div.stacks.test div.quickflip-wrapper').each(function(ev){
			var cardURL = $(this).find('a.front').attr('href');
			//Bind the click to the card
			$(this).click(function(){
				window.location.href = cardURL.toString();
			});
			
			$(this).hover(function(){
				//on
				$(this).quickFlipper();
			},function(){
				//off
				$(this).quickFlipper();
			});
		});
		
		//Make the text fit
		$('div.stacks.test div.test-card div.test-card-data a.front').each(function(){
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
		});
		$('div.stacks.test div.test-card div.test-card-data a.back').each(function(){
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
	
	function shuffleCards(){
		alert("Shuffling cards...");
	}
</script>