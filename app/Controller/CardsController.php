<?php
App::uses('AppController', 'Controller');
/**
 * Cards Controller
 *
 * @property Card $Card
 */
class CardsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Card->recursive = 0;
		$this->set('cards', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Card->id = $id;
		if (!$this->Card->exists()) {
			throw new NotFoundException(__('Invalid card'));
		}
		$this->Card->contain(array('Stack'=>array('Tag','Color','User'),'Tag','Color','User'));
		$this->set('card', $this->Card->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($stack_id=null) {
		if(!$stack_id){
			$this->Session->setFlash(__('You must provide a stack id.'));
			$this->redirect(array('controller'=>'users','action' => 'login'));
		}
		/*
		TODO:
			Check to make sure that the user can add a card to this stack. 
			Check to see if they are the owner or a collaborator of the stack.
		*/
		if ($this->request->is('post')) {
			$this->Card->create();
			if ($this->Card->save($this->request->data)) {
				$this->Session->setFlash(__('The card has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The card could not be saved. Please, try again.'));
			}
		}
		$stack = $this->Card->Stack->read(null,$stack_id);
		$user_id = $this->Auth->user('id');
		//Only show stacks from the logged in user.
		//TODO: If the user is collaborating with other stacks, show those as well
		$stacks = $this->Card->Stack->find('list',array('conditions'=>array('Stack.user_id'=>$user_id)));
		$colors = $this->Card->Color->find('list');
		$users = $this->Card->User->find('list');
		$this->set(compact('stacks', 'colors', 'users','stack'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Card->id = $id;
		if (!$this->Card->exists()) {
			throw new NotFoundException(__('Invalid card'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Card->save($this->request->data)) {
				$this->Session->setFlash(__('The card has been saved'));
				$card = $this->Card->read(null,$id);
				$this->redirect(array('controller'=>'stacks','action' => 'view',$card['Card']['stack_id']));
			} else {
				$this->Session->setFlash(__('The card could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Card->read(null, $id);
		}
		$stacks = $this->Card->Stack->find('list');
		$colors = $this->Card->Color->find('list');
		$users = $this->Card->User->find('list');
		$this->set(compact('stacks', 'colors', 'users'));
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
		$this->Card->id = $id;
		if (!$this->Card->exists()) {
			throw new NotFoundException(__('Invalid card'));
		}
		if ($this->Card->delete()) {
			$this->Session->setFlash(__('Card deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Card was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
