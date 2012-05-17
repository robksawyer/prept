<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users form">
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User', array('action' => 'create_password')); ?>
	<fieldset>
		<legend><?php echo __('Create a password'); ?></legend>
		<?php
			echo $this->Form->input('new_password', array('label' => __('New Password', true),'type' => 'password'));
			echo $this->Form->input('confirm_password', array('label' => __('Confirm', true),'type' => 'password'));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>