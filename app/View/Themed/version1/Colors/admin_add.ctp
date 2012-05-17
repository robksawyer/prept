<div class="colors form">
<?php echo $this->Form->create('Color');?>
	<fieldset>
		<legend><?php echo __('Add Color'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('hex');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Colors'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('admin'=>false,'controller' => 'stacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('admin'=>false,'controller' => 'stacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
