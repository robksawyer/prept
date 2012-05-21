<div class="cards view">
	<?php
		//Set defaults
		if(empty($card['Color'])) $card['Color']['hex'] = "ffffff";
		$card['Card']['Color'] = $card['Color'];
		$card['Card']['Tag'] = $card['Tag'];
		echo $this->element('flippable-card',array('cache'=>false,'data'=>$card['Card'],'counter'=>0));
	?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Card'), array('action' => 'edit', $card['Card']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Card'), array('action' => 'delete', $card['Card']['id']), null, __('Are you sure you want to delete # %s?', $card['Card']['id'])); ?> </li>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		
		//Card Flipping
		//http://dev.jonraasch.com/quickflip/docs
		$('div.view div.quickflip-wrapper').quickFlip();
		$('div.cards.view div.quickflip-wrapper').each(function(ev){
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
		
		//Shrink the titles
		$('div.cards.view div.card a.front').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('div.cards.view div.card').width() - (15*4); //15 = padding around each side
			if($(this).textWidth() > widthToFit){
				$(this).fitText(1, { minFontSize: '12px', maxFontSize: '24px' });
			}
		});
		$('div.cards.view div.card a.back').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('div.cards.view div.card').width() - (15*4); //15 = padding around each side
			if($(this).textWidth() > widthToFit){
				$(this).fitText(1, { minFontSize: '12px', maxFontSize: '24px' });
			}
		});
	
	});
</script>