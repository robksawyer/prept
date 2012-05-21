<?php
//debug($stack);
?>
<div class="stacks view">
	<?php
		//Set defaults
		if(empty($stack['Color'])) $stack['Color']['hex'] = "ffffff";
		echo $this->element('single-card',array('cache'=>false,'data'=>$stack));
	?>
</div>
<div class="clear"></div>
<div class="related" id="related-cards">
	<h3><?php echo __('Related Cards');?></h3>
	<?php if (!empty($stack['Card'])):?>
	<div class="card-container">
	<?php
		$i = 0;
		$counter = 0;
		foreach ($stack['Card'] as $card): 
			//Set defaults
			if(empty($card['Color'])) $card['Color']['hex'] = "ffffff";
			echo $this->element('flippable-card',array('cache'=>false,'data'=>$card,'counter'=>$counter));
		$counter += 1;
		endforeach; 
	?>
	</div>
<?php endif; ?>
<div class="clear">&nbsp;</div>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add A Card'), array('controller' => 'cards', 'action' => 'add',$stack['Stack']['id']));?> </li>
		</ul>
	</div>
</div>
<div class="actions" style="display: none">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stack'), array('action' => 'edit', $stack['Stack']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stack'), array('action' => 'delete', $stack['Stack']['id']), null, __('Are you sure you want to delete # %s?', $stack['Stack']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var maxFontSize = 24;
		var theStackCard = $('.stacks.view div.card div.card-data div.title');
		$(theStackCard).fitText(1, { minFontSize: '12px', maxFontSize: '24px' });
		$('div.stacks.view div.card').find('.card-links').fadeTo('slow',.5);
		
		//Card Flipping
		//http://dev.jonraasch.com/quickflip/docs
		$('div.related div.quickflip-wrapper').quickFlip();
		$('div.related div.quickflip-wrapper').each(function(ev){
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
		$('.related div.card a.front').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('.related div.card').width() - (15*4); //15 = padding around each side
			if($(this).textWidth() > widthToFit){
				$(this).fitText(1, { minFontSize: '12px', maxFontSize: '24px' });
			}
		});
		$('.related div.card a.back').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('.related div.card').width() - (15*4); //15 = padding around each side
			if($(this).textWidth() > widthToFit){
				$(this).fitText(1, { minFontSize: '12px', maxFontSize: '24px' });
			}
		});

		//Make the full card clickable
		//Change opacity of card on hover
		$('div.stacks.view div.card').hover(function(){
			var id = $(this).attr('id').substring($(this).attr('id').length,$(this).attr('id').length-1);
			$(this).find('#card-links-'+id).fadeTo('fast',1);
		},function(){
			var id = $(this).attr('id').substring($(this).attr('id').length,$(this).attr('id').length-1);
			$(this).find('#card-links-'+id).fadeTo('fast',.5);
		});
		
	});
</script>