<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('auto_login');
		echo $this->Form->input('role_id');
		echo $this->Form->input('attachment_id');
		echo $this->Form->input('profile_image_url');
		echo $this->Form->input('username');
		echo $this->Form->input('fullname');
		echo $this->Form->input('birthday');
		echo $this->Form->input('url');
		echo $this->Form->input('location');
		echo $this->Form->input('about');
		echo $this->Form->input('gender');
		echo $this->Form->input('active');
		echo $this->Form->input('banned');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('slug');
		echo $this->Form->input('hide_competitions');
		echo $this->Form->input('hide_welcome');
		echo $this->Form->input('status');
		echo $this->Form->input('signature');
		echo $this->Form->input('locale');
		echo $this->Form->input('timezone');
		echo $this->Form->input('email_on_like');
		echo $this->Form->input('email_on_comment');
		echo $this->Form->input('notify_on_follow');
		echo $this->Form->input('notify_on_like');
		echo $this->Form->input('totalLikes');
		echo $this->Form->input('staff_favorite');
		echo $this->Form->input('facebook_id');
		echo $this->Form->input('twitter_id');
		echo $this->Form->input('public_key');
		echo $this->Form->input('currentLogin');
		echo $this->Form->input('lastLogin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cards'), array('controller' => 'cards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('controller' => 'stacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('controller' => 'stacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
