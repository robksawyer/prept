<?php
App::uses('AppController', 'Controller');
/**
 * Stacks Controller
 *
 * @property Stack $Stack
 */
class StacksController extends AppController {
	
	public $helpers = array('Javascript','Ajax');
	
	/**
	 * Search stacks
	 *	https://github.com/CakeDC/search
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Stack->parseCriteria($this->passedArgs);
		$this->set('stacks', $this->paginate());
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Stack->recursive = 0;
		$this->Stack->contain('Tag','Color','User');
		//Search by tag
		if (isset($this->passedArgs['by'])) {
			$this->paginate = array(
				'Tagged' => array(
					'tagged',
					'model' => 'Stack',
					'by' => $this->passedArgs['by'],
					'limit' => 10
				)
			);
			$stacks = $this->paginate('Tagged');
			$counter = 0;
			/*
				Find more details. I haven't found an easier way. Recursive doesn't seem to work in the paginate. 
				Maybe a condition function would work.
			*/
			foreach($stacks as $stack){
				if(!empty($stack['Stack']['id'])){
					$t_stack = $this->Stack->find('first',array('conditions'=>array(
																										'Stack.id' => $stack['Stack']['id']
																										),
																				'contain' => array('User','Tag','Color')
																				)
																			);
					$stacks[$counter] = $t_stack;
					$counter++;
				}else{
					unset($stacks[$counter]);
				}
			}
		} else {
			$stacks = $this->paginate();
		}
		$this->set('tags', $this->Stack->Tagged->find('cloud', array('limit' => 10)));
		//$this->set('stacks', $this->paginate());
		$this->set(compact('stacks'));
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
		
		//Find only tags for the specific item
		$this->set('tags', $this->Stack->Tagged->find('cloud', array(
																						'limit' => 10,
																						'conditions'=>array('model'=>'Stack','foreign_key'=>$id)
																						)));
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
	 * make method
	 * This is the main interface for the user to create stacks and make study cards.
	 * @return void
	 */
		public function make() {
			
			$totalCardsToStart = 5;
			if($this->Session->read('Card.count') > $totalCardsToStart){
				$totalCardsToStart = $this->Session->read('Card.count');
			}
			
			if ($this->request->is('post')) {
				//Clean up the card array
				$titleValue = 'Title of Studycard';
				if(trim($this->request->data['Stack']['title']) == $titleValue){
					$this->request->data['Stack']['title'] = '';
				}
				$descriptionValue = 'Write a short description of your stack. This helps identify the stack for you and your friends.';
				if(trim($this->request->data['Stack']['description']) == $descriptionValue){
					$this->request->data['Stack']['description'] = '';
				}
				$tagValue = 'Enter optional subjects, i.e., history, math.';
				if(trim($this->request->data['Stack']['tags']) == $tagValue){
					$this->request->data['Stack']['tags'] = '';
				}
				$frontValue = 'Enter the term here. Press tab to go to next input box.';
				$backValue = 'Enter the definition here.';
				$totalCards = count($this->request->data['Card']);
				for($i=0;$i<=$totalCards;$i++){
					if(!empty($this->request->data['Card'][$i])){
						$this->request->data['Card'][$i]['front'] = trim($this->request->data['Card'][$i]['front']);
						$this->request->data['Card'][$i]['back'] = trim($this->request->data['Card'][$i]['back']);
						if($this->request->data['Card'][$i]['front'] == $frontValue){
							//Unset this item
							unset($this->request->data['Card'][$i]);
						}
						if(!empty($this->request->data['Card'][$i])){
							if($this->request->data['Card'][$i]['back'] == $backValue){
								$this->request->data['Card'][$i]['back'] = null;
							}
						}
					}
				}
				
				$this->Stack->set($this->request->data);
				if($this->Stack->validates()){
					$this->Stack->create();
					if ($this->Stack->saveAll($this->request->data,array('validate'=>false))) {
						$this->Session->setFlash(__('Your stack has been saved – good luck with your studies.'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The stack could not be saved. Please, try again.'));
					}
				}else{
					// didn't validate logic
					$errors = $this->Stack->validationErrors;
				}
			}else{
				//Delete the card count variable on refresh. If you 
				//don't do this, when the user goes to add a new card, the number will be off.
				$this->Session->delete('Card.startingCardCount');
				$this->Session->delete('Card.count');
				
				$this->Session->write('Card.startingCardCount',$totalCardsToStart);
				$this->Session->write('Card.count',$totalCardsToStart);
			}
			
			$colors = $this->Stack->Color->find('list');
			$users = $this->Stack->User->find('list');
			$this->set(compact('totalCardsToStart','colors', 'users'));
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
		
		$this->set('tags', $this->Stack->Tagged->find('cloud', array('limit' => 10)));
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
