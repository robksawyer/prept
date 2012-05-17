<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div style="padding:15px 0 100px 0;background:#ececec;width:100%;margin:0 0 0 0;color:#000000;">
	<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
		<div style="background:black;min-height:20px;width:100%;padding:0;margin:0 auto">&nbsp;</div>
		<div style="width:440px;margin:0 auto">
			<?php 
				$user_name = $user['User']['fullname'];
				$user_email = $user['User']['email'];
				$admin_URL = Router::url(array('ajax'=>false,'controller'=>'users','action'=>'admin',$user['User']['password_token']),true);
			?>
			<h1 style="font-size:20px;margin:40px 0 20px 0;color:#000000;">Thanks for signing up and choosing us <?php echo $this->Html->link($user_name,$admin_URL,array('style'=>'color:#ef3f23')); ?>!.</h1>
			<div style="width:440px;margin:0 auto">
				<h3>You can sign into your account using the following information.</h3>
				<ul>
					<li>username: <?php echo $user_email; ?></li>
					<li><?php echo $this->Html->link($admin_URL,$admin_URL,array('style'=>'color:#ef3f23')); ?></li>
				</ul>
			</div>
		</div>
		<div style="width:100%;clear:both;"></div>
		<div style="background:black;width:516px;margin:25px auto 25px;font-size:12px;text-align:center;overflow:auto;color:#ffffff;padding:15px 0px 15px 0px;">
			Sent from <?php echo $this->Html->link("FIND | GET | MAKE",'http://www.find-get-make.com',array('target'=>'_blank','style'=>'color:#ffffff')); ?> | <?php echo $this->Html->link("Edit Email Notifications",Router::url(array('ajax'=>false,'controller'=>'settings','action'=>'notifications'),true),array('target'=>'_blank','style'=>'color:#ffffff')); ?>
		</div>
		<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
        <div style="width:440px;margin:0 auto"></div>
      </div>
	</div>
</div>