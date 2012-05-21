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
<?php
	echo $this->Html->script('card-utils');
?>
