<div class="cards view">
	<div class="stacks view" title="The card you are viewing is in the stack <?php echo $card['Stack']['title']; ?>">
		<span class="stack-title">Stack</span>
		<?php
			$stack = $card['Stack'];
			//Set defaults
			if(empty($stack['Color'])) $stack['Color']['hex'] = "ffffff";
		?>
		<div class="card" id="stack-card-<?php echo $stack['id']; ?>" style="background-color: #<?php echo $stack['Color']['hex']; ?>">
			<span class="card-overlay">&nbsp;</span>
			<div class="card-data">
				<div class="title" id="stack-title-<?php echo $stack['id']; ?>"><?php echo $this->Html->link($stack['title'],array('controller'=>'stacks','action'=>'view',$stack['id']),array('class'=>'stack-title')); ?></div>
				<div class="description"><?php echo $stack['description']; ?>&nbsp;</div>
				<div class="user" style="display:none"><?php echo $this->Html->link($stack['User']['fullname'], array('controller' => 'users', 'action' => 'view', $stack['User']['id'])); ?>&nbsp;</div>
			</div>
		</div>
	</div>
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
		
		var maxFontSize = 24;
		var widthToFit = $('div.cards.view div.card').width() - (15*4); //15 = padding around each side
		//Shrink the titles
		$('div.stacks.view div.card a.stack-title').fitText(1, { minFontSize: '9px', maxFontSize: '14px' });
		if($('div.cards.view div.card a.front').textWidth() > widthToFit){
			$('div.cards.view div.card a.front').fitText(1,{minFontSize: '12px', maxFontSize: '24px'});
		}
		if($('div.cards.view div.card a.back').textWidth() > widthToFit){
			$('div.cards.view div.card a.back').fitText(1,{minFontSize: '12px', maxFontSize: '24px'});
		}
		
		//Make the full card clickable
		var stackURL = $('div.stacks.view div.card').find('a.stack-title').attr('href');
		//Bind the click to the card
		$('div.stacks.view div.card').click(function(){
			window.location.href = stackURL.toString();
		});
		
		//Change opacity of card on hover
		$('div.stacks.view div.card').hover(function(){
			$('div.stacks.view div.card').stop().animate({"opacity": 1});
		},function(){
			$('div.stacks.view div.card').stop().animate({"opacity": .4});
		});
	});
</script>