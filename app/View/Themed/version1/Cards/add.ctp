<div class="cards form">
<?php echo $this->Form->create('Card');?>
	<fieldset>
		<legend><?php echo __('Add Card'); ?></legend>
	<?php
		echo $this->Form->input('Card.front',array('label'=>false,'value'=>'Enter the term here. Press tab to go to next input box.','class'=>'card-front'));
		echo $this->Form->input('Card.back',array('label'=>false,'value'=>'Enter the definition here.','class'=>'card-back'));
		echo $this->Form->input('stack_id',array('type'=>'hidden','value'=>$stack['Stack']['id']));
		echo $this->Form->input('color_id',array('type'=>'hidden'));
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$current_user['id']));
		echo "<div class='tags'>";
		echo $this->Form->input('tags',array('label'=>false,'value'=>'Enter optional subjects, i.e., history, math.','div'=>false));
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cards'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('controller' => 'stacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('controller' => 'stacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
