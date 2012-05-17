<?php
App::uses('AppController', 'Controller');
/**
 * Stacks Controller
 *
 * @property Stack $Stack
 */
class StacksController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Stack->recursive = 0;
		$this->set('stacks', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		$this->set('stack', $this->Stack->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Stack->create();
			if ($this->Stack->save($this->request->data)) {
				$this->Session->setFlash(__('The stack has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stack could not be saved. Please, try again.'));
			}
		}
		$colors = $this->Stack->Color->find('list');
		$users = $this->Stack->User->find('list');
		$this->set(compact('colors', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Stack->save($this->request->data)) {
				$this->Session->setFlash(__('The stack has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stack could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Stack->read(null, $id);
		}
		$colors = $this->Stack->Color->find('list');
		$users = $this->Stack->User->find('list');
		$this->set(compact('colors', 'users'));
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
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		if ($this->Stack->delete()) {
			$this->Session->setFlash(__('Stack deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Stack was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Stack->recursive = 0;
		$this->set('stacks', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		$this->set('stack', $this->Stack->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Stack->create();
			if ($this->Stack->save($this->request->data)) {
				$this->Session->setFlash(__('The stack has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stack could not be saved. Please, try again.'));
			}
		}
		$colors = $this->Stack->Color->find('list');
		$users = $this->Stack->User->find('list');
		$this->set(compact('colors', 'users'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Stack->save($this->request->data)) {
				$this->Session->setFlash(__('The stack has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stack could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Stack->read(null, $id);
		}
		$colors = $this->Stack->Color->find('list');
		$users = $this->Stack->User->find('list');
		$this->set(compact('colors', 'users'));
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
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		if ($this->Stack->delete()) {
			$this->Session->setFlash(__('Stack deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Stack was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
