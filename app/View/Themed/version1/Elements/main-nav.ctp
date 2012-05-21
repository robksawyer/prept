<!-- Main nav -->
<div class="main-nav">
	<div class="logo"><?php echo $this->Html->link($this->Html->image('/img/common/site-logo-99x81.jpg',array('alt' => $siteDescription,'border'=>'0')), '/',array('escape' => false)); ?></div>
	<ul>
	<?php
		echo "<li>".$this->Html->link('Search Studycards',array('controller'=>'stacks','action'=>'find'))."</li>";
		echo "<li>".$this->Html->link('Make Studycards',array('controller'=>'stacks','action'=>'make'))."</li>";
		echo "<li>".$this->Html->link('Features Tour','#')."</li>";
	?>
	</ul>
</div>
<?php
$hide_user_panel = false;
//Check to make sure the panel should show on the view
$ignored_views = array('/users/login','/users/signup');
foreach($ignored_views as $view){
	if($view == $this->request->here){
		$hide_user_panel = true;
	}
}

if(!$hide_user_panel):
?>
<div class="user-panel">
<?php
//Check to see if the user is logged in
if(!empty($logged_in)):	
	echo 'Hi '.$this->Html->link($current_user['fullname'],array('controller'=>'users','action'=>'backpack','admin'=>false))."! -  ".$this->Html->link('Logout',array('admin'=>false,'controller'=>'users','action'=>'logout'));
else:
	echo $this->Html->link('Login',array('admin'=>false,'controller'=>'users','action'=>'login'));
	echo " | ".$this->Html->link('Create Account',array('admin'=>false,'controller'=>'users','action'=>'signup'));
endif; 
?>
</div>
<?php endif; ?>
<div class="clear"></div>