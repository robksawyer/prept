<?php 
/**
 * Sample Comments Application
 *
 * Copyright 2009 - 2010, Cake Development Corporation
 *                        1785 E. Sahara Avenue, Suite 490-423
 *                        Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2009 - 2010, Cake Development Corporation (http://cakedc.com)
 * @link      http://github.com/CakeDC/Sample-Comments-Application
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
if (!$this->Session->check('Auth.Users')) {
	echo $this->Form->create('User', array(
		'url' => array(
			'admin' => false,
			'plugin' => 'users',
			'controller' => 'users',
			'action' => 'login'),
		'id' => 'LoginForm'));
	echo $this->Form->input('email', array(
		'label' => __('Email')));
	echo $this->Form->input('passwd', array(
		'label' => __('Password'),
		'type' => 'password'));
	echo $this->Form->end(__('Login'));
}
?>