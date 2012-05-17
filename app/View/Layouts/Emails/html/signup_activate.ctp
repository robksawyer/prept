
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
				$activation_URL = Router::url(array('ajax'=>false,'admin'=>false,'controller'=>'users','action'=>'verify','email',$token),true);
			?>
			<h1 style="font-size:20px;margin:40px 0 20px 0;color:#000000;">Hello <?php echo $user['User']['fullname']; ?>,</h1>
			<div style="width:440px;margin:0 auto">
				<h2>Congratulations! Your account has been setup.</h2>
				<div>
					But you're not finished yet.
					<br>
					To activate your account, you must visit the URL below within 24 hours.
					<br>
					<?php echo $this->Html->link($activation_URL,$activation_URL); ?>
					<br>
					
					Sincerely,
					 	The Prept Team
				</div>
			</div>
		</div>
		<div style="width:100%;clear:both;"></div>
		<div style="background:black;width:516px;margin:25px auto 25px;font-size:12px;text-align:center;overflow:auto;color:#ffffff;padding:15px 0px 15px 0px;">
			Sent from <?php echo $this->Html->link("Trapped Tracks",'http://www.prept.com',array('target'=>'_blank','style'=>'color:#ffffff')); ?> | <?php echo $this->Html->link("Edit Email Notifications",Router::url(array('ajax'=>false,'controller'=>'settings','action'=>'notifications'),true),array('target'=>'_blank','style'=>'color:#ffffff')); ?>
		</div>
		<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
        <div style="width:440px;margin:0 auto"></div>
      </div>
	</div>
</div>