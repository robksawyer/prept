<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	/**
	 * CakePHP beforeFilter
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout','reset','reset_password','verify','signup');
		
		if ($this->action == 'register') {
			$this->Auth->enabled = false;
		}

		if ($this->action == 'login') {
			$this->Auth->autoRedirect = false;
		}
				
		/*if (!Configure::read('App.defaultEmail')) {
			Configure::write('App.defaultEmail', 'noreply@' . env('HTTP_HOST'));
		}*/
	}
	
	/**
	 * Logs the user in
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function login() {
		//Automatically redirect the user if they've already logged in
		$this->Auth->autoRedirect = false;
		if($this->Auth->user()){
			$this->redirect($this->Auth->redirect());
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				//Update lastLogin and currentLogin times
				$user = $this->Auth->user();
				$this->User->read(null,$user['id']);
				if(empty($user['currentLogin'])){
					$user['currentLogin'] = date('Y-m-d H:i:s');
				}
				$this->User->set(array(
									'lastLogin' => $user['currentLogin'],
									'currentLogin' => date('Y-m-d H:i:s')
									));
				if(!$this->User->save()){
					//There was an error updating the login times.
				}
				
				if ($this->here == $this->Auth->loginRedirect) {
					$this->Auth->loginRedirect = '/';
				}

				/*$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username')));
				if (!empty($this->request->data)) {
					$data = $this->request->data[$this->modelClass];
					$this->_setCookie();
				}*/

				if (empty($data['return_to'])) {
					$data['return_to'] = null;
				}
				return $this->redirect($this->Auth->redirect($data['return_to']));
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
		
		if (isset($this->request->params['named']['return_to'])) {
			$this->set('return_to', urldecode($this->request->params['named']['return_to']));
		} else {
			$this->set('return_to', false);
		}
	}
	
	/**
	 * Signup.
	 * Allows a user to generate an account in the system.
	 * @access public
	 */
	public function signup() {
		//$this->set('title_for_layout','Sign Up');
		//$this->layout = 'clean';
		
		if ($this->request->is('post')) {
			$this->request->data['User']['username'] = strip_tags($this->request->data['User']['username']);
			$this->request->data['User']['fullname'] = strip_tags($this->request->data['User']['fullname']);
			$this->request->data['User']['location'] = strip_tags($this->request->data['User']['location']);
			//$this->request->data['User']['slug'] = $this->toSlug($this->request->data['User']['username']); //Should happen automagically with the Sluggable plugin
			
			//Register the user
			$user = $this->User->register($this->request->data,true,false);
			if (!empty($user)) {
				//Generate a public key that the user can use to login later (without username and password)
				//$this->User->generateAndSavePublicKey($user);
				
				//Send the user their activation email
				$options = array(
									'layout'=>'signup_activate',
									'subject'=>__('Activate your account at Prept!', true),
									'view'=>'default'
									);
				$viewVars = array('user'=>$user,'token'=>$user['User']['email_token']);
				$this->_sendEmail($user['User']['email'],$options,$viewVars);
				$this->User->id = $user['User']['id'];
				$this->request->data['User']['id'] = $this->User->id; 
				$this->Auth->autoRedirect = false;
				if($this->Auth->login($this->request->data['User'])){
					//The login was a success
					unset($this->request->data['User']);
					$this->Session->setFlash(__('You have successfully created an account &mdash; now get to studying.', true));
					$this->Auth->loginRedirect = array('admin'=>false,'controller'=>'users','action'=>'backpack');
					return $this->redirect($this->Auth->loginRedirect);
				}else{
					$this->Session->setFlash(__("There was an error logging you in.", true));
					$this->redirect(array('admin'=>false,'action' => 'login'));
				}
			}
		}
		
	}
	
	/**
	 * This is the user landing page after login
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function backpack() {
		//debug($this->current_user);
		$user = $this->Auth->user();
		if(empty($user)){
			$this->Session->setFlash(__('You are not authorized to access that location.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->paginate = array(
			'Stack' => array(
				'conditions'=>array('Stack.user_id' => $this->current_user['id'])
			),
			'Test' => array(
				'conditions'=>array('Test.user_id' => $this->current_user['id']),
				'recursive' => '-1'
			)
		);
		$user_tests = $this->paginate('Test');
		$user_stacks = $this->paginate('Stack');
		$this->set(compact('user_stacks','user_tests'));
	}
	
	
	/**
	 * Logs the user out
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function logout() {
		$user = $this->Auth->user();
		$this->Session->destroy();
		$this->Cookie->destroy();
		$this->Session->setFlash(sprintf(__('%s you have successfully logged out'), $user[$this->{$this->modelClass}->displayField]));
		$this->redirect($this->Auth->logout());
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$attachments = $this->User->Attachment->find('list');
		$this->set(compact('attachments'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$attachments = $this->User->Attachment->find('list');
		$this->set(compact('attachments'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$attachments = $this->User->Attachment->find('list');
		$this->set(compact('attachments'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$attachments = $this->User->Attachment->find('list');
		$this->set(compact('attachments'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 * Confirm email action
	 *
	 * @param string $type Type
	 * @return void
	 */
	public function verify($type = 'email') {
		if($this->logged_in === true){
			//Log the user out
			$this->Auth->logoutRedirect = '';
			$this->Auth->logout();
		}
		if (isset($this->request->params['pass']['1'])){
			$token = $this->request->params['pass']['1'];
		} else {
			$this->redirect(array('action' => 'login'), null, true);
		}

		if ($type === 'email') {
			$data = $this->User->validateToken($token);
		} elseif($type === 'reset') {
			$data = $this->User->validateToken($token, true);
		} else {
			$this->Session->setFlash(__('The url you accessed is no longer valid', true));
			$this->redirect(array('action' => 'login'));
		}

		if ($data !== false) {
			$email = $data['User']['email'];
			$passwd = $data['User']['passwd'];

			if ($type === 'reset') {
				$newPassword = $data['User']['passwd'];
				$data['User']['passwd'] = AuthComponent::password($newPassword); //Hash the new password
				//$data['User']['passwd'] = Security::hash($newPassword, null, true);
			}

			if ($type === 'email') {
				$data['User']['active'] = 1;
				//BUG FIX: Unset the passwd field or else when saved, it'll get hashed again.
				unset($data['User']['passwd']);
			}
			
			if ($this->User->save($data, false)) {
				if ($type === 'reset') {
					$options = array(
										'layout'=>'signup_activate',
										'subject'=>__('Password Reset', true),
										'view'=>'default'
										);
					$viewVars = array('data'=>$data,'newPassword'=>$newPassword);
					$this->_sendEmail($email,$options,$viewVars);
					
					$this->Session->setFlash(__('Your password was sent to your registered email account', true));
					$this->redirect(array('action' => 'login'));
				} else {
					$this->User->id = $data['User']['id'];
					//$this->User->save($data); //Save the data
					//Log the user in with the auto generated password and then send them along to the create password page
					//$loginData['User'] = array('email'=>$email,'passwd'=>$passwd);
					$this->request->data['User']['id'] = $this->User->id;
					$this->Auth->autoRedirect = false;
					if($this->Auth->login($this->request->data['User'])){
						//The login was a success
						$this->Session->setFlash(__('Your e-mail has been validated!', true));
						$this->Auth->loginRedirect = array('admin'=>false,'controller'=>'users','action'=>'backpack');
						return $this->redirect($this->Auth->loginRedirect);
					}else{
						$this->Session->setFlash(__("There was an error logging you in."));
						$this->redirect(array('action' => 'login'));
					}
				}
			} else {
				$this->Session->setFlash(__('There was an error trying to validate your e-mail address. Please check your e-mail for the URL you should use to verify your e-mail address.', true));
				$this->redirect(array('action' => 'login'));
			}
		} else {
			$this->Session->setFlash(__('The url you accessed is no longer valid', true));
			$this->redirect('/');
		}
	}
	
	/**
	* Allows the user to enter a new password, it needs to be confirmed
	* @return void
	*/
	public function change_password() {
		if (!empty($this->request->data)) {
			$this->request->data['User']['id'] = $this->Auth->user('id');
			if ($this->User->changePassword($this->request->data)) {
				$this->Session->setFlash(__('Password changed.', true));
				$this->redirect('/');
			}
		}
	}
	
	/**
	* Allows the user to create a password. This happens after the user verifies their email address
	* @return void
	*/
	public function create_password() {
		if(!empty($this->request->params['named']['email'])){
			$email = $this->request->params['named']['email'];
		}
		
		$authUserData = $this->Auth->user();
		if(empty($authUserData)){
			$this->Session->setFlash(__('There was an error logging you in and setting up a password. Your temporary password has been sent to your email address.', true));
			//Send the temporary password to the user's email address
			$options = array(
								'layout'=>'temporary_password',
								'subject'=>'Your Temporary Password',
								'view'=>'default'
								);
			$viewVars = array('temp_password'=>$authUserData['User']['email'],'user'=>$user);

			//Send the email
			$this->_sendEmail($email,$options,$viewVars);
			$this->redirect(array('controller'=>'users','action'=>'login'));
		}
		
		$user = $this->User->find('first',array('conditions'=>array('email'=>$authUserData['User']['email'])));
		if (!empty($this->request->data)) {
			$this->request->data['User']['id'] = $user['User']['id']; //Get the logged in user's id
			if ($this->User->verifyNewPassword($this->request->data)) {
				$this->Session->setFlash(__('Password created.', true));
				$this->redirect(array('controller'=>'uploads','action'=>'index'));
			}
		}
	}

	/**
	* Reset Password Action
	*
	* Handles the trigger of the reset, also takes the token, validates it and let the user enter
	* a new password.
	*
	* @param string $token Token
	* @param string $user User Data
	* @return void
	*/
	public function reset_password($token = null, $user = null) {
		if(empty($token)) {
			$admin = false;
			if($user) {
				$this->request->data = $user;
				$admin = true;
			}
			$this->_sendPasswordReset($admin); //Show the forgot password form
		} else {
			$this->__resetPassword($token); //Show the reset password form
		}
	}
	
	/**
	 * Sets the cookie to remember the user
	 *
	 * @param array Cookie component properties as array, like array('domain' => 'yourdomain.com')
	 * @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the model alias to make sure it works with different apps with different user models across different (sub)domains.
	 * @return void
	 * @link http://book.cakephp.org/2.0/en/core-libraries/components/cookie.html
	 */
	protected function _setCookie($options = array(), $cookieKey = 'User') {
		if (empty($this->request->data[$this->modelClass]['remember_me'])) {
			$this->Cookie->delete($cookieKey);
		} else {
			$validProperties = array('domain', 'key', 'name', 'path', 'secure', 'time');
			$defaults = array(
				'name' => 'rememberMe');

			$options = array_merge($defaults, $options);
			foreach ($options as $key => $value) {
				if (in_array($key, $validProperties)) {
					$this->Cookie->{$key} = $value;
				}
			}

			$cookieData = array(
				'email' => $this->request->data[$this->modelClass]['email'],
				'password' => $this->request->data[$this->modelClass]['password']);
			$this->Cookie->write($cookieKey, $cookieData, true, '1 Month');
		}
		unset($this->request->data[$this->modelClass]['remember_me']);
	}
	
	/**
	* Sends the verification email
	*
	* This method is protected and not private so that classes that inherit this
	* controller can override this method to change the verification mail sending
	* in any possible way.
	*
	* @param string $to Receiver email address
	* @param array $options EmailComponent options
	* @param array $viewVars view variables to pass along
	* @return boolean Success
	*/
	protected function _sendEmail($to = null,$options = array(),$viewVars=array()) {
		if(!empty($to)){
			if(empty($options['view'])){
				$options['view'] = 'default';
			}
			$email = new CakeEmail('standard'); //Use the standard config template
			$email->template($options['view'], $options['layout'])
						->emailFormat('html')
						->to($to)
						->subject($options['subject'])
						->viewVars($viewVars)
						->send();
			return true;
		}
		return false;
	}
	
	/**
	* Checks if the email is in the system and authenticated, if yes create the token
	* save it and send the user an email
	*
	* @param boolean $admin Admin boolean
	* @param array $options Options
	* @return void
	*/
	protected function _sendPasswordReset($admin = null, $options = array()) {			
		if (!empty($this->request->data)) {
			
			$user = $this->User->passwordReset($this->request->data);

			if (!empty($user)) {
				$options = array(
									'layout'=>'password_reset_request',
									'subject'=>'Password Reset',
									'view'=>'default'
									);
				$viewVars = array('token'=>$user['User']['password_token'],'user'=>$user);
	
				//Send the email
				$this->_sendEmail($user['User']['email'],$options,$viewVars);
				
				$this->set('token', $user['User']['password_token']);
				if ($admin) {
					$this->Session->setFlash(sprintf(
						__('%s has been sent an email with instruction to reset their password.', true),
						$user['User']['email']));
					$this->redirect(array('action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash(__('You should receive an email with further instructions shortly.', true));
					$this->redirect(array('action' => 'login'));
				}
			} else {
				$this->Session->setFlash(__('No user was found with that email.', true));
				$this->redirect($this->referer('/'));
			}
		}
		$this->render('request_password_change');
	}

	/**
	* Sets the cookie to remember the user
	*
	* @param array Cookie component properties as array, like array('domain' => 'yourdomain.com')
	* @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the 
	* model alias to make sure it works with different apps with different user models accross different (sub)domains.
	* @return void
	* @link http://api13.cakephp.org/class/cookie-component
	*/
	/*protected function _setCookie($options = array(), $cookieKey = 'User') {
		if (empty($this->request->data['User']['remember_me'])) {
			$this->Cookie->delete($cookieKey);
		} else {
			$validProperties = array('domain', 'key', 'name', 'path', 'secure', 'time');
			$defaults = array(
				'name' => 'rememberMe');

			$options = array_merge($defaults, $options);
			foreach ($options as $key => $value) {
				if (in_array($key, $validProperties)) {
					$this->Cookie->{$key} = $value;
				}
			}

			$cookieData = array();
			$cookieData[$this->Auth->fields['username']] = $this->request->data['User'][$this->Auth->fields['email']];
			$cookieData[$this->Auth->fields['password']] = $this->request->data['User'][$this->Auth->fields['password']];
			$this->Cookie->write($cookieKey, $cookieData, true, '1 Month');
		}
		unset($this->request->data['User']['remember_me']);
	}*/

	/**
	* This method allows the user to change his password if the reset token is correct
	*
	* @param string $token Token
	* @return void
	*/
	private function __resetPassword($token) {
		$user = $this->User->checkPasswordToken($token);
		if(empty($user)) {
			$this->Session->setFlash(__('Invalid password reset token, try again.', true));
			$this->redirect(array('action' => 'reset_password'));
		}

		if (!empty($this->request->data)) {
			if ($this->User->resetPassword(Set::merge($user, $this->request->data))) {
				$this->Session->setFlash(__('Password changed, you can now login with your new password.', true));
				$this->redirect($this->Auth->loginAction);
			}
		}

		$this->set('token', $token);
	}
}
