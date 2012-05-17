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
	<?php echo $this->Form->create('User', array('url' => array('admin' => false, 'action' => 'reset_password'))); ?>
	<fieldset>
		<legend><?php echo __('Forgot your password?'); ?></legend>
		<p><?php __('Please enter the email you used for registration and you\'ll get an email with further instructions.'); ?></p>
		<?php
		echo $this->Form->input('email', array('label' => __('Your Email', true)));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
