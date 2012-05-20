<?php
App::uses('AppController', 'Controller');
/**
 * Stacks Controller
 *
 * @property Stack $Stack
 */
class AjaxController extends AppController {
	
	public $helpers = array('Javascript','Ajax');
	
	/**
	 * Adds a card to the stack when requested
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function add_card() {
		$this->autoRender = false;
		$startingCardCount = $this->Session->read('Card.startingCardCount');
		$cardCount = $this->Session->read('Card.count');
		if(empty($cardCount)){
			$cardCount = $startingCardCount;
		}
		
		//Set the variables
		if(empty($this->request->params['named']['containsUserData'])){
			$this->request->params['named']['containsUserData'] = false;
		}
		$showRemoveBtn = $this->request->params['named']['showRemoveBtn'];
		$containsUserData = $this->request->params['named']['containsUserData'];
		$totalCardsToStart = $this->request->params['named']['totalCardsToStart'];
		$num = $cardCount;
		//Set after
		$cardCount += 1;
		$this->Session->write('Card.count', $cardCount);
		
		$user_id = $this->request->params['named']['user_id'];
		
		$this->set(compact('showRemoveBtn','totalCardsToStart','containsUserData','num','user_id'));
		// render the element
		$this->viewPath = 'Elements';
		$this->render('add-card','ajax');
	}
	
	/**
	 * This method handles removing a count from the session counter
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function remove_card($startingCount=5) {
		$this->autoRender = false;
		
		$cardCount = $this->Session->read('Card.count');
		if(empty($cardCount)){
			$cardCount = $startingCount;
		}else{
			$cardCount -= 1;
		}
		$this->Session->write('Card.count', $cardCount);
	}
}