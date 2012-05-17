<div class="cards form">
<?php echo $this->Form->create('Card');?>
	<fieldset>
		<legend><?php echo __('Add Card'); ?></legend>
	<?php
		echo $this->Form->input('front');
		echo $this->Form->input('back');
		echo $this->Form->input('stack_id',array('type'=>'hidden','value'=>$stack['Stack']['id']));
		echo $this->Form->input('color_id',array('type'=>'hidden'));
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$current_user['id']));
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
