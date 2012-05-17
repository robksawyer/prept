<?php
?>
<div class="users form">
	<fieldset>
		<legend>
			<?php __('Sign Up'); ?>
			<p><?php __('Signup is quick and easy and if you don\'t like the site, there\'s a money back guarantee*. All fields are required.'); ?></p>
		</legend>
			<?php 
			echo $this->Session->flash();
			echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'signup')));
			echo $this->Form->input('fullname', array('label' => __('Real Name', true)));
			echo $this->Form->input('username', array('label' => __('Username', true),'after'=>'<div class="after">Your public profile: http://www.prept.com/profile/<span class="username-preview">'.$this->Form->value('User.username').'</span></div>'));
			echo $this->Form->input('location', array('label' => __('Location', true)));
			echo $this->Form->input('email', array('label' => __('Email', true),'after'=>'Note: We will not sell your email address.'));
			echo $this->Form->input('passwd', array('type' => 'password', 'label' => __('Password', true)));
			echo $this->Form->input('temppassword', array('type' => 'password', 'label' => __('Confirm Password', true)));
			
			//echo $this->Form->input('security', array('after' => ' '. $this->Cupcake->settings['security_question'], 'label' => __('Security Question', true), 'style' => 'width: 10%')); 
			echo $this->Form->end(__('Sign Up', true)); 
			?>
		</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Have an account?'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('Login Here',array('controller'=>'users','action'=>'login'),array('title'=>'Login Here'));?></li>
	</ul>
</div>
<script type="text/javascript">
$("#UserUsername").keyup(function(){
	$('span.username-preview').text($(this).val());
});
</script>