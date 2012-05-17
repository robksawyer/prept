<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//App::uses('Core', 'Security');
/**
 * User Model
 *
 * @property Attachment $Attachment
 * @property Card $Card
 * @property Comment $Comment
 * @property Stack $Stack
 */
class User extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fullname';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'fullname' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true, 
				'allowEmpty' => false,
				'message' => 'Please enter your name, so we\'ll know what to call you.'
			),
			'name_min' => array(
				'rule' => array('minLength', '3'),
				'message' => 'Your name must be more than 3 characters, right?'
			)
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Your must enter a username.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'The email address entered is not valid. Please try again or contact us if you think this is a mistake.',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must enter an email address',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'passwd' => array(
			'to_short' => array(
				'rule' => array('minLength', '6'),
				'message' => 'The password must have at least 6 characters.',
				'allowEmpty' => false,
				'required' => true,
			),
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a password.',
				'allowEmpty' => false,
				'required' => true
			)
		),
		'temppassword' => array(
			'rule' => 'confirmPassword',
			'message' => 'The passwords are not equal, please try again.'
		),
		//'new_password' => $this->validate['passwd'],
		'confirm_password' => array(
			'required' => array(
				'rule' => array('compareFields', 'new_password', 'confirm_password'), 
				'required' => true, 
				'message' => 'The passwords are not equal.'
			)
		),
		'old_password' => array(
			'to_short' => array(
				'rule' => 'validateOldPassword', 
				'required' => true, 
				'message' => 'Invalid password.'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/**
	 * Behaviors
	 *
	 * @var array
	 */
	public $actsAs = array(
		'Utils.Sluggable' => array(
			'label' => 'username',
			'method' => 'multibyteSlug'
		)
	);
		
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'attachment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Card' => array(
			'className' => 'Card',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Stack' => array(
			'className' => 'Stack',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	/**
	 * Fires when the user saves data.
	 * @param
	 * @return void
	 */
	/*public function beforeSave() {
		//Was called by changePassword()
		/*$this->validatePasswordChange = array(
			'new_password' => $this->validate['passwd'],
			'confirm_password' => array(
				'required' => array('rule' => array('compareFields', 'new_password', 'confirm_password'), 'required' => true, 'message' => __('The passwords are not equal.', true))),
			'old_password' => array(
				'to_short' => array('rule' => 'validateOldPassword', 'required' => true, 'message' => __('Invalid password.', true))));*/
		
		//This was causing problems when trying to update the User data
		/*if (isset($this->data[$this->alias]['passwd'])) {
			//$this->data[$this->alias]['passwd'] = Security::hash($this->data[$this->alias]['passwd'], null, true);
			$this->data[$this->alias]['passwd'] = AuthComponent::password($this->data[$this->alias]['passwd']);
		}*/
		//return true;
	//}
	
	
	/**
	 * Custom validation method to ensure that the two entered passwords match
	 *
	 * @param string $password Password
	 * @return boolean Success
	 */
	public function confirmPassword($password = null) {
		if ((isset($this->data[$this->alias]['passwd']) && isset($password['temppassword']))
			&& !empty($password['temppassword'])
			&& ($this->data[$this->alias]['passwd'] === $password['temppassword'])) {
			return true;
		}
		return false;
	}

	/**
	 * Compares the email confirmation
	 *
	 * @param array $email Email data
	 * @return boolean
	 */
	public function confirmEmail($email = null) {
		if ((isset($this->data[$this->alias]['email']) && isset($email['confirm_email']))
			&& !empty($email['confirm_email'])
			&& (strtolower($this->data[$this->alias]['email']) === strtolower($email['confirm_email']))) {
				return true;
		}
		return false;
	}
	
	/**
	 * Returns the logged in user's info
	 * @return array
	 */
	public function getUserInfo(){
		$authUser = $this->Auth->user();
		$this->find('first',array('conditions'=>array('email'=>$authUser['User']['email'])));
	}

	/**
	 * Validates the user token
	 *
	 * @param string $token Token
	 * @param boolean $reset Reset boolean
	 * @param boolean $now time() value
	 * @return mixed false or user data
	 */
	public function validateToken($token = null, $reset = false, $now = null) {
		if (!$now) {
			$now = time();
		}
		$this->recursive = -1;
		$data = false;
		$match = $this->find('first',array(
										'conditions' => array($this->alias.'.email_token' => $token),
										'fields' => array('id', 'email', 'email_token_expires', 'role_id','passwd')
									));

		if (!empty($match)){
			$expires = strtotime($match[$this->alias]['email_token_expires']);
			if ($expires > $now) {
				$data[$this->alias]['id'] = $match[$this->alias]['id'];
				$data[$this->alias]['email'] = $match[$this->alias]['email'];
				$data[$this->alias]['email_authenticated'] = '1';
				$data[$this->alias]['email_verified'] = '1';
				$data[$this->alias]['role_id'] = $match[$this->alias]['role_id'];

				if ($reset === true) {
					//Generate a new password for the user
					$data[$this->alias]['passwd'] = $this->generatePassword();
					//$data[$this->alias]['password_token'] = null;
				}else{
					$data[$this->alias]['passwd'] = $match[$this->alias]['passwd']; //So that I can log the user in afterwards
				}
				
				$testing = false;
				if(!$testing){
					$data[$this->alias]['email_token'] = null;
					$data[$this->alias]['email_token_expires'] = null;
				}
			}
		}
		return $data;
	}

	/**
	 * Updates the last activity field of a user
	 *
	 * @param string $user User ID
	 * @return boolean True on success
	 */
	public function updateLastActivity($userId = null) {
		if (!empty($userId)) {
			$this->id = $userId;
		}
		if ($this->exists()) {
			return $this->saveField('last_activity', date('Y-m-d H:i:s', time()));
		}
		return false;
	}

	/**
	 * Checks if an email is in the system, validated and if the user is active so that the user is allowed to reste his password
	 *
	 * @param array $postData post data from controller
	 * @return mixed False or user data as array on success
	 */
	public function passwordReset($postData = array()) {
		$this->recursive = -1;
		$user = $this->find('first', array(
			'conditions' => array(
				$this->alias . '.active' => 1,
				$this->alias . '.email' => $postData[$this->alias]['email'])));

		if (!empty($user) && $user[$this->alias]['email_verified'] == 1) {
			$sixtyMins = time() + 43000;
			$token = $this->generateToken();
			$user[$this->alias]['password_token'] = $token;
			$user[$this->alias]['email_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
			$user = $this->save($user, false);
			$this->data = $user;
			return $user;
		} elseif (!empty($user) && $user[$this->alias]['email_verified'] == 0){
			$this->invalidate('email', __d('users', 'This Email Address exists but was never validated.'));
		} else {
			$this->invalidate('email', __d('users', 'This Email Address does not exist in the system.'));
		}

		return false;
	}

	/**
	 * Checks the token for a password change
	 * 
	 * @param string $token Token
	 * @return mixed False or user data as array
	 */
	public function checkPasswordToken($token = null) {
		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.active' => 1,
				$this->alias . '.password_token' => $token,
				$this->alias . '.email_token_expires >=' => date('Y-m-d H:i:s'))));
		if (empty($user)) {
			return false;
		}
		return $user;
	}

	/**
	 * Resets the password
	 * 
	 * @param array $postData Post data from controller
	 * @return boolean True on success
	 */
	public function resetPassword($postData = array()) {
		$result = false;
		$tmp = $this->validate;
		$this->validate = array(
			'new_password' => $this->validate['passwd'],
			'confirm_password' => array(
				'required' => array(
					'rule' => array('compareFields', 'new_password', 'confirm_password'), 
					'message' => __('The passwords are not equal.', true)
					)
				)
		);

		$this->set($postData);
		if ($this->validates()) {
			//$this->data[$this->alias]['passwd'] = Security::hash($this->data[$this->alias]['new_password'], null, true);
			$this->data[$this->alias]['passwd'] = AuthComponent::password($this->data[$this->alias]['new_password']);
			$this->data[$this->alias]['password_token'] = null;
			$result = $this->save($this->data, false);
		}
		$this->validate = $tmp;
		return $result;
	}

	/**
	 * Changes the password for a user
	 *
	 * @param array $postData Post data from controller
	 * @return boolean True on success
	 */
	public function changePassword($postData = array()) {
		$this->set($postData);
		$tmp = $this->validate;
		//$this->validate = $this->validatePasswordChange;
		$this->validate = array(
			'new_password' => $this->validate['passwd'],
			'confirm_password' => array('required' => array(
																		'rule' => array('compareFields', 'new_password', 'confirm_password'), 
																		'required' => true, 
																		'message' => __('The passwords are not equal.', true)
																	)
											),
			'old_password' => array('to_short' => array(
																	'rule' => 'validateOldPassword', 
																	'required' => true, 
																	'message' => __('Invalid password.', true)
																)
											)
									);
				
		if ($this->validates()) {
			//$this->data[$this->alias]['passwd'] = Security::hash($this->data[$this->alias]['new_password'], null, true);
			$this->data[$this->alias]['passwd'] = AuthComponent::password($this->data[$this->alias]['new_password']);
			$this->save($postData, array('validate' => false,'callbacks' => false));
			$this->validate = $tmp;
			return true;
		}

		$this->validate = $tmp;
		return false;
	}
	
	/**
		* Creates the password for a user
	 *
	 * @param array $postData Post data from controller
	 * @return boolean True on success
	 */
	public function verifyNewPassword($postData = array()) {
		$this->data = $postData;
		$tmp = $this->validate;
		//$this->validate = $this->validatePasswordChange;
		$this->validate = array(
			'new_password' => $this->validate['passwd'],
			'confirm_password' => array('required' => array(
															'rule' => array('compareFields', 'new_password', 'confirm_password'), 
																		'required' => true, 
																		'message' => __('The passwords are not equal.', true)
																	)
											)
									);
		//Set the user id so that we can update the account
		$this->id = $this->data[$this->alias]['id'];
		if ($this->validates()) {
			//$this->data[$this->alias]['passwd'] = Security::hash($this->data[$this->alias]['new_password'], null, true);
			$this->data[$this->alias]['passwd'] = AuthComponent::password($this->data[$this->alias]['new_password']);
			unset($this->data[$this->alias]['new_password']);
			unset($this->data[$this->alias]['confirm_password']);
			$this->save($this->data, array('validate' => false,'callbacks' => false));
			$this->validate = $tmp;
			return true;
		}

		$this->validate = $tmp;
		return false;
	}
	
	/**
	 * Validation method to check the old password
	 *
	 * @param array $password 
	 * @return boolean True on success
	 */
	public function validateOldPassword($password) {
		if (!isset($this->data[$this->alias]['id']) || empty($this->data[$this->alias]['id'])) {
			if (Configure::read('debug') > 0) {
				throw new OutOfBoundsException(__('$this->data[\'' . $this->alias . '\'][\'id\'] has to be set and not empty', true));
			}
		}

		$passwd = $this->field('passwd', array($this->alias . '.id' => $this->data[$this->alias]['id']));
		//if ($passwd === Security::hash($password['old_password'], null, true)) {
		if ($passwd === AuthComponent::password($password['old_password'], null, true)) {
			return true;
		}
		return false;
	}

	/**
	 * Validation method to compare two fields
	 *
	 * @param mixed $field1 Array or string, if array the first key is used as fieldname
	 * @param string $field2 Second fieldname
	 * @return boolean True on success
	 */
	public function compareFields($field1, $field2) {
		if (is_array($field1)) {
			$field1 = key($field1);
		}
		if (isset($this->data[$this->alias][$field1]) && isset($this->data[$this->alias][$field2]) && 
			$this->data[$this->alias][$field1] == $this->data[$this->alias][$field2]) {
			return true;
		}
		return false;
	}

	/**
	 * Returns all data about a user
	 *
	 * @param string $slug user slug
	 * @return array
	 */
	public function view($slug = null) {
		$user = $this->find('first', array(
			'contain' => array(
				//'Tag',
				'Detail'),
			'conditions' => array(
				$this->alias . '.slug' => $slug,
				'OR' => array(
					'AND' =>
						array($this->alias . '.active' => 1, $this->alias . '.email_authenticated' => 1),
						//array($this->alias . '.active' => 1, $this->alias . '.account_type' => 'remote')
						))));

		if (empty($user)) {
			throw new Exception(__('The user does not exist.', true));
		}

		return $user;
	}

	/**
	 * Registers a new user
	 *
	 * @param array $postData Post data from controller
	 * @param boolean $useEmailVerification If set to true a token will be generated
	 * @return mixed
	 */
	public function register($postData = array(), $useEmailVerification = true, $generatePassword = false) {
		$postData = $this->_beforeRegistration($postData, $useEmailVerification);
		$this->_removeExpiredRegistrations();

		$this->set($postData);
		if ($this->validates()) {
			if($generatePassword === false){
				//Happens in beforeSave now
				$postData[$this->alias]['passwd'] = AuthComponent::password($postData[$this->alias]['passwd']);
				//$postData[$this->alias]['passwd'] = Security::hash($postData[$this->alias]['passwd'], 'sha1', true);
			}else{
				$postData[$this->alias]['passwd'] = $this->generatePassword();
				//$postData[$this->alias]['passwd'] = Security::hash($postData[$this->alias]['passwd'], 'sha1', true);
			}
			$this->create();
			return $this->save($postData, false);
		}

		return false;
	}

	/**
	 * Registers a new user
	 *
	 * @param array $postData Post data from controller
	 * @param boolean $useEmailVerification If set to true a token will be generated
	 * @return mixed
	 */
	public function setupUser($postData = array(), $useEmailVerification = true, $generatePassword = true) {
		$postData = $this->_beforeRegistration($postData, $useEmailVerification);
		$this->_removeExpiredRegistrations();

		//$this->set($postData);
		//if ($this->validates()) {
			if($generatePassword === false){
				//Happens in beforeSave now
				//$postData[$this->alias]['passwd'] = Security::hash($postData[$this->alias]['passwd'], 'sha1', true);
			}else{
				$postData[$this->alias]['passwd'] = $this->generatePassword();
				//$postData[$this->alias]['passwd'] = Security::hash($postData[$this->alias]['passwd'], 'sha1', true);
			}
			
			return $postData[$this->alias];
		//}

		// return false;
	}
	
	/**
	 * Activates the user account
	 * @param id int The user id to activate
	 */
	public function activate($id=null){
		$user = $this->read(null,$id);
		if(!empty($user)){
			if($user['User']['active'] === 0){
				$this->id = $id;
				$this->set('active',1);
				$this->save();
			}
			return true;
		}
		return false;
	}
	
	/**
	 * Resends the verification if the user is not already validated or invalid
	 *
	 * @param array $postData Post data from controller
	 * @return mixed False or user data array on success
	 */
	public function resendVerification($postData = array()) {
		if (!isset($postData[$this->alias]['email']) || empty($postData[$this->alias]['email'])) {
			$this->invalidate('email', __('Please enter your email address.', true));
			return false;
		}

		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.email' => $postData[$this->alias]['email'])));

		if (empty($user)) {
			$this->invalidate('email', __('The email address does not exist in the system', true));
			return false;
		}

		if ($user[$this->alias]['email_authenticated'] == 1) {
			$this->invalidate('email', __('Your account is already authenticaed.', true));
			return false;
		}

		if ($user[$this->alias]['active'] == 0) {
			$this->invalidate('email', __('Your account is disabled.', true));
			return false;
		}

		$user[$this->alias]['email_token'] = $this->generateToken();
		$user[$this->alias]['email_token_expires'] = date('Y-m-d H:i:s', time() + 86400);

		return $this->save($user, false);
	}

	/**
	 * Generates a password
	 *
	 * @param int $length Password length
	 * @return string
	 */
	public function generatePassword($length = 10) {
		srand((double)microtime() * 1000000);
		$password = '';
		$vowels = array("a", "e", "i", "o", "u");
		$cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr",
							"cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl");
		for ($i = 0; $i < $length; $i++) {
			$password .= $cons[mt_rand(0, 31)] . $vowels[mt_rand(0, 4)];
		}
		return substr($password, 0, $length);
	}

	/**
	 * Generate token used by the user registration system
	 *
	 * @param int $length Token Length
	 * @return string
	 */
	public function generateToken($length = 10) {
		$possible = '0123456789abcdefghijklmnopqrstuvwxyz';
		$token = "";
		$i = 0;

		while ($i < $length) {
			$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
			if (!stristr($token, $char)) {
				$token .= $char;
				$i++;
			}
		}
		return $token;
	}

	/**
	 * Optional data manipulation before the registration record is saved
	 *
	 * @param array post data array
	 * @param boolean Use email generation, create token, default true
	 * @return array
	 */
	protected function _beforeRegistration($postData = array(), $useEmailVerification = true) {
		if ($useEmailVerification == true) {
			$postData[$this->alias]['email_token'] = $this->generateToken();
			$postData[$this->alias]['email_token_expires'] = date('Y-m-d H:i:s', time() + 86400);
		} else {
			$postData[$this->alias]['email_authenticated'] = 1;
		}
		$postData[$this->alias]['active'] = 0; //By default set the account to inactive
		return $postData;
	}
		
		
	/**
	 * Removes all users from the user table that are outdated
	 *
	 * Override it as needed for your specific project
	 *
	 * @return void
	 */
	protected function _removeExpiredRegistrations() {
		$this->deleteAll(array(
			$this->alias . '.email_authenticated' => 0,
			$this->alias . '.email_token_expires <' => date('Y-m-d H:i:s')
			)
		);
	}
	
	/**
	 * Verifies a users email by a token that was sent to him via email and flags the user record as active
	 *
	 * @param string $token The token that wa sent to the user
	 * @return array On success it returns the user data record
	 */
	public function verifyEmail($token = null) {
		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.email_verified' => 0,
				$this->alias . '.email_token' => $token),
			'fields' => array(
				'id', 'email', 'email_token_expires', 'role')));

		if (empty($user)) {
			throw new RuntimeException(__d('users', 'Invalid token, please check the email you were sent, and retry the verification link.'));
		}

		$expires = strtotime($user[$this->alias]['email_token_expires']);
		if ($expires < time()) {
			throw new RuntimeException(__d('users', 'The token has expired.'));
		}

		$data[$this->alias]['active'] = 1;
		$user[$this->alias]['email_verified'] = 1;
		$user[$this->alias]['email_token'] = null;
		$user[$this->alias]['email_token_expires'] = null;

		$user = $this->save($user, array(
			'validate' => false,
			'callbacks' => false));
		$this->data = $user;
		return $user;
	}
	
	/**
	 * This handles verifying that the key passed, matches the lo
	 * @param Int username The username to verify against
	 * @param String passed_key The key to verify
	 * @return 
	 * 
	*/
	public function verifyPublicKey($passed_key=""){
		$this->recursive = -1;
		$pk = str_replace("fgmpk_","",$passed_key);
		$user = $this->find('first',array('conditions'=>array(
															'User.public_key'=>$pk
															)));
		if(!empty($user['User']['id'])){
			return $user;
		}else{
			return false;
		}
	}

	/**
	 * Generates and saves a public key into the database for a user.
	 * @param Array user The user to add a key for
	 * @return 
	 * 
	*/
	public function generateAndSavePublicKey($user){
		$pk = $this->generatePublicKey($user['User']['username']);
		$this->Post->read(null, $user['User']['id']);
		$this->set('public_key',$pk);
		if($this->save()){
			return $pk;
		}else{
			return false;
		}
	}
		
	/**
	 * Handles generating a random string for the auth user. This is used so that the user can 
	 * use items like the bookmarklet helper without having to login each time.
	 * @param username The name to generate the key from.
	 * @return 
	 * 
	*/
	protected function generatePublicKey($username=null){
		$pk = Security::hash($username.Configure::read('Security.salt'));
		return $pk;
	}

}
