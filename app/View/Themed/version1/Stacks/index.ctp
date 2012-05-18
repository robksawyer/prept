<div class="stacks index">
	<h2><?php 
		if(!empty($this->request->params['named']['by'])){
			echo __('Stacks tagged <i>'.$this->request->params['named']['by']."</i>");
		}else{
			echo __('Stacks');
		}
	?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('color_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<tr>
	<?php
	$counter = 0;
	foreach ($stacks as $stack): 
	?>
			<td class="card" id="card-<?php echo $counter; ?>" style="<?php echo "background: #".$stack['Color']['hex']; ?>">
				<div class="card-data">
					<?php
						echo $this->Html->link(__($stack['Stack']['title']), array('action' => 'view', $stack['Stack']['id']),array('class'=>'title','id'=>'title-'.$counter))
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
	<!--<tr>
		<td><?php //echo h($stack['Stack']['id']); ?>&nbsp;</td>
		<td><?php //echo h($stack['Stack']['title']); ?>&nbsp;</td>
		<td><?php //echo h($stack['Stack']['description']); ?>&nbsp;</td>
		<td>
			<?php //echo $this->Html->link($stack['Color']['name'], array('controller' => 'colors', 'action' => 'view', $stack['Color']['id'])); ?>
		</td>
		<td>
			<?php //echo $this->Html->link($stack['User']['fullname'], array('controller' => 'users', 'action' => 'view', $stack['User']['id'])); ?>
		</td>
		<td><?php //echo h($stack['Stack']['created']); ?>&nbsp;</td>
		<td><?php //echo h($stack['Stack']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $stack['Stack']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $stack['Stack']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stack['Stack']['id']), null, __('Are you sure you want to delete # %s?', $stack['Stack']['id'])); ?>
		</td>
	</tr>-->
<?php 
	$counter += 1; //Increment the counter
	endforeach; 
?>
	</tr>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Stack'), array('action' => 'add')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		//Shrink the titles
		$('td.card a.title').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('td.card').width() - (15*4); //15 = padding around each side
			if($(this).textWidth() > widthToFit){
				$(this).fitText(1.5, { minFontSize: '12px', maxFontSize: '24px' });
			}
		});
		
		//Make the full card clickable
		$('td.card').each(function(){
			//Set the initial opacity of the card
			$(this).css({"opacity": .7});
			
			var stackURL = $(this).find('a').attr('href');
			//Bind the click to the card
			$(this).click(function(){
				window.location.href = stackURL.toString();
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
