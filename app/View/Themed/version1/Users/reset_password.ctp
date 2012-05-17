<div class="users form">
	<?php echo $this->Form->create($model, array('url' => array('action' => 'reset_password',$token))); ?>
	<fieldset>
		<legend><?php echo __('Reset your password'); ?></legend>
		<?php
			echo $this->Form->input('new_password', array('label' => __('New Password', true),'type' => 'password'));
			echo $this->Form->input('confirm_password', array('label' => __('Confirm', true),'type' => 'password'));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>