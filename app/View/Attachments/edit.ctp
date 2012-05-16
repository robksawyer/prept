<div class="attachments form">
<?php echo $this->Form->create('Attachment');?>
	<fieldset>
		<legend><?php echo __('Edit Attachment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('title');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('filesize');
		echo $this->Form->input('ext');
		echo $this->Form->input('group');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('path');
		echo $this->Form->input('path_small');
		echo $this->Form->input('path_med');
		echo $this->Form->input('source_url');
		echo $this->Form->input('uploaded');
		echo $this->Form->input('votes');
		echo $this->Form->input('user_id');
		echo $this->Form->input('model');
		echo $this->Form->input('model_id');
		echo $this->Form->input('keycode');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Attachment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Attachment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
