<?php
App::uses('AppController', 'Controller');
/**
 * Stacks Controller
 *
 * @property Stack $Stack
 */
class StacksController extends AppController {
	
	public $helpers = array('Javascript','Ajax');
	
	public $presetVars = array(
			array('field' => 'title', 'type' => 'value'),
			array('field' => 'description', 'type' => 'value'),
			array('field' => 'color_id', 'type' => 'value')
			/*array(
				'field' => 'tags',
				'type' => 'lookup',
				'formField' => 'blog_input',
				'modelField' => 'title',
				'model' => 'Blog'
			)*/
		);
	
	/**
	 * Search stacks
	 *	https://github.com/CakeDC/search
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function find() {
		$this->Stack->recursive = -1;
		$searched = false;
		$titleVal = 'Search the title';
		$descriptionVal = 'Search the description of the stack.';
		$tagVal = 'Search the tags, i.e., history, math.';
		
		if ($this->request->is('post')) {
			if($this->request->data['Stack']['title'] == $titleVal) $this->request->data['Stack']['title'] = null;
			if($this->request->data['Stack']['description'] == $descriptionVal) $this->request->data['Stack']['description'] = null;
			if($this->request->data['Stack']['tags'] == $tagVal) $this->request->data['Stack']['tags'] = null;
			
		}
		
		$this->Prg->commonProcess(); //Convert the passed args to params for the search
		$this->paginate = array(
			'Stack' => array(
				'conditions' => $this->Stack->parseCriteria($this->passedArgs),
				'contain' => array('Tag','Color')
				//'recursive' => 1
			)
		);
		if(!empty($this->passedArgs)){
			$searched = true;
		}
		$stacks = $this->paginate('Stack');
		$this->set(compact('stacks'));
		$colors = $this->Stack->Color->find('list');
		$users = $this->Stack->User->find('list');
		$this->set(compact('colors', 'users','searched'));
	}
	
	/**
	 * Search stacks
	 *	https://github.com/CakeDC/search
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function findQuery() {
		$this->Stack->recursive = -1;
		$searched = false;
		
		if($this->request->is('post')) {
			$filterVal='Search for titles OR tags';
			if($this->request->data['Stack']['filter'] == $filterVal){
				$this->request->data['Stack']['filter'] = null;
			}
			if(empty($this->request->data['Stack']['color_id'])) unset($this->request->data['Stack']['color_id']);
			
			if(!empty($this->request->data['Stack']['filter'])){
				$searchQuery = $this->request->data['Stack']['filter'];
				$stacks = $this->searchByTitle($searchQuery);
				if(empty($stacks)){
					unset($this->request->data['Stack']['title']);
					$stacks = $this->searchByTags($searchQuery);
				}
			}else{
				$stacks = $this->searchByColor();
			}
		}else{
			unset($this->request->data['Stack']['filter']);
			$this->Prg->commonProcess(); //Convert the passed args to params for the search
			$this->paginate = array(
				'Stack' => array(
					'conditions' => $this->Stack->parseCriteria($this->passedArgs),
					'contain' => array('Tag','Color')
					//'recursive' => 1
				)
			);
			$this->Stack->contain('User','Tag','Color');
			$stacks = $this->paginate('Stack');
		}
		
		if(!empty($this->passedArgs)){
			$searched = true;
		}
		$colors = $this->Stack->Color->find('list');
		$users = $this->Stack->User->find('list');
		$finderQuery = true;
		$this->set(compact('colors', 'users','searched','stacks','finderQuery'));
		$this->render('find');
	}
	
	/**
	 * Uses the search string and searches the title field
	 *
	 * @param string searchQuery The string to search
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function searchByTitle($searchQuery=''){
		//Split the results at the AND and the OR. If the split contains a , consider it a search for tags
		$words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $searchQuery, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		if(!empty($words)){
			$foundComparison = false;
			for($i=0;$i<count($words);$i++){
				if($words[$i] == 'OR'){
					unset($words[$i]);
					$words = array_merge($words);
					//$titles = implode(" OR ",$words);
					$this->request->data['Stack']['filter_or'] = $words;
					$foundComparison = true;
				}else if($words[$i] == 'AND'){
					unset($words[$i]);
					$words = array_merge($words);
					//$titles = implode(" AND ",$words);
					$this->request->data['Stack']['filter_and'] = $words;
					$foundComparison = true;
				}
			}
			if(!$foundComparison){
				$this->request->data['Stack']['title'] = $searchQuery;
			}
		}
		unset($this->request->data['Stack']['filter']);
		$this->Prg->commonProcess(); //Convert the passed args to params for the search
		$this->paginate = array(
			'Stack' => array(
				'conditions' => $this->Stack->parseCriteria($this->passedArgs),
				'contain' => array('Tag','Color')
				//'recursive' => 1
			)
		);
		$this->Stack->contain('User','Tag','Color');
		$stacks = $this->paginate('Stack');
		unset($this->request->data['Stack']['title']);
		return $stacks;
	}
	
	/**
	 * Uses the search string and searches the tags
	 *
	 * @param string searchQuery The string to search
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function searchByTags($searchQuery=''){
		
		//Split the results at the AND and the OR. If the split contains a , consider it a search for tags
		$words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $searchQuery, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		
		//Search Tags when using commas and Titles when using AND/OR
		if(strpos($searchQuery,",")){
			//Make a tag query
			$tags = implode(", ",$words);
			//Set the data for the search
			$this->request->data['Stack']['tags'] = $tags;
		}
		unset($this->request->data['Stack']['filter']);
		$this->Prg->commonProcess(); //Convert the passed args to params for the search
		$this->paginate = array(
			'Stack' => array(
				'conditions' => $this->Stack->parseCriteria($this->passedArgs),
				'contain' => array('Tag','Color')
				//'recursive' => 1
			)
		);
		$this->Stack->contain('User','Tag','Color');
		$stacks = $this->paginate('Stack');
		unset($this->request->data['Stack']['tags']);
		return $stacks;
	}
	
	public function searchByColor(){
		unset($this->request->data['Stack']['filter']);
		if(empty($this->request->data['Stack']['color_id'])){
			$this->redirect($this->referer());
		}
		
		$this->Prg->commonProcess(); //Convert the passed args to params for the search
		$this->paginate = array(
			'Stack' => array(
				'conditions' => $this->Stack->parseCriteria($this->passedArgs),
				'contain' => array('Tag','Color')
				//'recursive' => 1
			)
		);
		$this->Stack->contain('User','Tag','Color');
		$stacks = $this->paginate('Stack');
		return $stacks;
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Stack->recursive = -1;
		$this->Stack->contain('Tag','Color','User','Card');
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
		$this->set(compact('stacks'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Stack->recursive = 1;
		$this->Stack->id = $id;
		if (!$this->Stack->exists()) {
			throw new NotFoundException(__('Invalid stack'));
		}
		
		//Find only tags for the specific item
		$this->set('tags', $this->Stack->Tagged->find('cloud', array(
																						'limit' => 10,
																						'conditions'=>array('model'=>'Stack','foreign_key'=>$id)
																						)));
		$this->Stack->contain(array('Card'=>array('Tag','Color'),'Tag','User','Color'));
		$stack = $this->Stack->read(null, $id);
		$this->set('stack', $stack);
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
						if($this->request->data['Card'][$i]['front'] == $frontValue || $this->request->data['Card'][$i]['front'] == ''){
							//Unset this item
							unset($this->request->data['Card'][$i]);
						}
						if(!empty($this->request->data['Card'][$i])){
							if($this->request->data['Card'][$i]['back'] == $backValue || $this->request->data['Card'][$i]['back'] == ''){
								$this->request->data['Card'][$i]['back'] = null;
							}
						}
					}
				}
				
				$this->Stack->set($this->request->data);
				if($this->Stack->validates()){
					//$this->Stack->create();
					if ($this->Stack->saveAll($this->request->data,array('validate'=>false))) {
						$this->Session->setFlash(__('Your stack has been saved – good luck with your studies.'));
						$this->redirect(array('controller'=>'users','action' => 'backpack'));
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
