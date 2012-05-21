<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $theme = 'version1';
	public $components = array('Auth' => array(
											'authenticate' => array('Form' => array(
																				'userModel' => 'User',
																				'fields' => array(
																										'username' => 'email',
																										'password' => 'passwd'
																										),
																				'scope' => array(
																									'User.active' => 1,
																									'User.email_verified' => 1
																									)
																				)
																			),
											'loginAction' => array('controller' => 'users', 'action' => 'login'),
											'loginRedirect' => array('controller' => 'users', 'action' => 'backpack'),
											'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
											),'Session', 'Email', 'Cookie','RequestHandler','Search.Prg');
											
	public $helpers = array('Html', 'Form', 'Session','Number', 'Time', 'Text','Js' => array('Jquery'),'Tags.TagCloud');
	
	public $logged_in = false;
	public $current_user = array();
	
	public function beforeFilter() {
		$this->Auth->allow('index', 'view');
		
		$this->logged_in = $this->Auth->loggedIn();
		$this->current_user = $this->Auth->user();
		$logged_in = $this->logged_in;
		$current_user = $this->current_user;
		App::uses('Color','Model');
		$this->Color = new Color();
		$colors = $this->Color->getList();
		
		$this->set(compact('logged_in','current_user','colors'));
	}
	
	/**
	 * Fires before the page is rendered
	 */
	public function beforeRender(){
		
	}
	
}
