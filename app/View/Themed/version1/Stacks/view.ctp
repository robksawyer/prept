<?php
//debug($stack);
?>
<div class="stacks view">
	<div class="card" id="card-<?php echo $stack['Stack']['id']; ?>" style="background-color: #<?php echo $stack['Color']['hex']; ?>">
		<span class="card-overlay">&nbsp;</span>
		<div class="card-data">
			<div class="title">
				<?php echo h($stack['Stack']['title']); ?>
			</div>
			<div class="description">
				<?php echo h($stack['Stack']['description']); ?>
				&nbsp;
			</div>
			<div class="user" style="display:none">
				<?php echo $this->Html->link($stack['User']['fullname'], array('controller' => 'users', 'action' => 'view', $stack['User']['id'])); ?>
				&nbsp;
			</div>
			<div class="tags">
				<ul id="tagcloud">
					<?php 
						echo $this->TagCloud->display($tags, array(
							'before' => '<li class="tag">',
							'after' => '</li>',
							'url' => array('controller'=>'stacks','action'=>'index')
							)
						);
					?>
				</ul>
			</div>
		</div>
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
<div class="related">
	<h3><?php echo __('Related Cards');?></h3>
	<?php if (!empty($stack['Card'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Front'); ?></th>
		<th><?php echo __('Back'); ?></th>
		<th><?php echo __('Stack Id'); ?></th>
		<th><?php echo __('Color Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Tags'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		$counter = 0;
		foreach ($stack['Card'] as $card): ?>
		<tr>
			<td class="card" id="card-<?php echo $counter; ?>" style="<?php echo "background: #".$stack['Color']['hex']; ?>">
				<span class="card-overlay">&nbsp;</span>
				<div class="card-data">
					<?php
						echo $this->Html->link(__($stack['Stack']['title']), array('controller'=>'cards','action' => 'view', $stack['Stack']['id']),array('class'=>'title','id'=>'title-'.$counter))
					?>
					<!--<p class="description"><?php //echo $stack['Stack']['description']; ?></p>-->
					<ul id="tagcloud">
						<?php 
							foreach ($stack['Tag'] as $tag) {
								//echo '<li class="tag">'.$this->Html->link($tag['name'],array('controller'=>'stacks','action'=>'index','by'=>$tag['keyname'])).'</li>';
								echo '<li class="tag">'.$tag['name'].'</li>';
							}
						?>
					</ul>
				</div>
			</td>
		</tr>
	<?php 
		$counter += 1;
		endforeach; 
	?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add',$stack['Stack']['id']));?> </li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var maxFontSize = 24;
		var theStackCard = $('div.card div.card-data div.title');
		var widthToFit = theStackCard.width() - (15*4); //15 = padding around each side
		if($(theStackCard).textWidth() > widthToFit){
			$(theStackCard).fitText(1.5, { minFontSize: '12px', maxFontSize: '24px' });
		}
		
		//Shrink the titles
		$('div.card a.title').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('div.card').width() - (15*4); //15 = padding around each side
			if($(this).textWidth() > widthToFit){
				$(this).fitText(1.5, { minFontSize: '12px', maxFontSize: '24px' });
			}
		});
		
		//Make the full card clickable
		$('td.card').each(function(){
			//Set the initial opacity of the card
			$(this).css({"opacity": .7});
			
			var cardURL = $(this).find('a').attr('href');
			//Bind the click to the card
			$(this).click(function(){
				window.location.href = cardURL.toString();
			});
			
			//Change opacity of card on hover
			$(this).hover(function(){
				$(this).stop().animate({"opacity": 1});
			},function(){
				$(this).stop().animate({"opacity": .7});
			});
		});
		
	});
</script>