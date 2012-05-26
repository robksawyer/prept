<?php
App::uses('AppController', 'Controller');
/**
 * Tests Controller
 *
 * @property Test $Test
 */
class TestsController extends AppController {
	
	public $helpers = array('Javascript','Ajax');
	
	/**
	 * This method handles testing the user's skills
	 *
	 * @param $stack_id The stack to test
	 * @param $test_type [terms,definitions] Whether or not the user wants to start the test with terms or definitions 
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function take($stack_id=null,$test_type='',$test_id = null) {
		if(!empty($test_type) && empty($test_id)){
			$this->Session->setFlash(__('You are not allowed to access this test.'));
			$this->redirect(array('controller'=>'users','action' => 'backpack'));
		}
		/* Check to see if an uncompleted test exist for the stack and user, 
		*  if it does, ask the user if they'd like to continue the test or start fresh.
		*/
		
		$this->Test->Stack->contain(array('Card'=>array('Tag','Color'),'Tag','User','Color'));
		$stack = $this->Test->Stack->read(null,$stack_id);
		if(empty($stack)){
			$this->Session->setFlash(__('This is not a valid stack.'));
			$this->redirect(array('controller'=>'users','action' => 'backpack'));
		}
		$user_id = $this->Auth->user('id');
		$existingTest = $this->Test->find('first', array('conditions'=>array('Test.stack_id'=>$stack['Stack']['id'],'Test.user_id'=>$user_id)));
		if($existingTest){
			$this->set(compact('existingTest'));
		}
		
		if($this->request->is('post')) {
			//Create the test record so that it can be updated as the user continues the test
			$this->request->data['Test']['user_id'] = $this->Auth->user('id');
			$this->request->data['Test']['completed'] = 0; //Only complete the test at the end when the user chooses to get their test results
			$this->request->data['Test']['score'] = 0;
			$this->request->data['Test']['stack_id'] = $stack['Stack']['id'];
			
			$test_type = $this->request->data['Test']['test_type'];
			$this->Test->create();
			if ($this->Test->save($this->request->data)) {
				$this->Session->setFlash(__('Let the test begin. Good luck!'));
				//$test = $this->Test->read(null,$this->Test->getLastInsertId());
				$test_id = $this->Test->getLastInsertId();
				$this->redirect(array('action' => 'take',$stack_id,$test_type,$test_id));
			} else {
				$this->Session->setFlash(__('There was an issue setting up the test. Please try again and if you continue to have issues, please contact us.'));
			}
		}
		
		if(!empty($test_id)){
			$this->Test->recursive = -1;
			$test = $this->Test->read(null,$test_id);
			$this->set(compact('test'));
		}
		
		$this->set(compact('stack'));
	}
	
	/**
	 * Check to see what the user wants to do about the existing test.
	 */
	public function existingTestUserPref(){
		$this->autoRender = false;
		
		if($this->request->is('post')) {
			$userPref = $this->request->data['Test']['user_test_pref'];
			$test = $this->Test->read(null,$this->request->data['Test']['id']);
			if(!empty($test)){
				$stack_id = $test['Test']['stack_id']; //Hold the stack id
				if($userPref == "continue"){
					$this->Session->setFlash(__('Good luck!'));
					$this->redirect(array('controller'=>'tests','action' => 'take',$stack_id,$test['Test']['test_type'],$test['Test']['id']));
				}else{
					//Delete the old test
					if (!$this->request->is('post')) {
						throw new MethodNotAllowedException();
					}
					$this->Test->id = $test['Test']['id'];
					if (!$this->Test->exists()) {
						throw new NotFoundException(__('Invalid test'));
					}
					if ($this->Test->delete()) {
						$this->Session->setFlash(__('We\'ve restarted the test. Good luck!'));
						$this->redirect(array('controller'=>'tests','action' => 'take',$stack_id));
					}
				}
			}
		}
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Test->recursive = 0;
		$this->set('tests', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Test->id = $id;
		if (!$this->Test->exists()) {
			throw new NotFoundException(__('Invalid test'));
		}
		$this->set('test', $this->Test->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Test->create();
			if ($this->Test->save($this->request->data)) {
				$this->Session->setFlash(__('The test has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.'));
			}
		}
		$users = $this->Test->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Test->id = $id;
		if (!$this->Test->exists()) {
			throw new NotFoundException(__('Invalid test'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Test->save($this->request->data)) {
				$this->Session->setFlash(__('The test has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Test->read(null, $id);
		}
		$users = $this->Test->User->find('list');
		$this->set(compact('users'));
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
		$this->Test->id = $id;
		if (!$this->Test->exists()) {
			throw new NotFoundException(__('Invalid test'));
		}
		if ($this->Test->delete()) {
			$this->Session->setFlash(__('Test deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Test was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
