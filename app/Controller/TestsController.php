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
	 * @param $id The stack to test
	 * @param $test_type [terms,definitions] Whether or not the user wants to start the test with terms or definitions 
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function take($id=null,$test_type='') {
		$this->Test->Stack->contain(array('Card'=>array('Tag','Color'),'Tag','User','Color'));
		$stack = $this->Test->Stack->read(null,$id);
		$this->set('stack', $stack);
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
