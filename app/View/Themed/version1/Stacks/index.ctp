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
		echo $this->element('card',array('cache'=>false,'counter'=>$counter,'data'=>$stack));
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
