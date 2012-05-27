<?php
App::uses('AppController', 'Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {

	public $helpers = array('Javascript','Ajax');
	
	/**
	 * DEPRECATED: I decided to just go with a final score and not updating the db each card
	 * This method handles updating the test with an answer to the question
	 *
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function answer(){
		if($this->RequestHandler->isAjax()){
			$this->autoRender = false;
			debug($this->request);
			/*
			$this->request->data['Question'] = $this->request->named;
			$this->request->data['Question']['user_id'] = $this->Auth->user('id');
			//Create a new record with the user's result
			$this->Question->create();
			if ($this->Question->save($this->request->data)) {
				if($this->request->data['Question']['score']=="right"){
					return "Good job";
				}else{
					return "Keep studying, you'll eventually get it.";
				}
			} else {
				return false;
			}*/
		}
	}
	
	/**
	* Makes the final score
	*/
	public function score(){
		$this->autoRender = false;
		debug($this->request->data);
		/*
		$this->request->data['Question'] = $this->request->named;
		$this->request->data['Question']['user_id'] = $this->Auth->user('id');
		//Create a new record with the user's result
		$this->Question->create();
		if ($this->Question->save($this->request->data)) {
			if($this->request->data['Question']['score']=="right"){
				return "Good job";
			}else{
				return "Keep studying, you'll eventually get it.";
			}
		} else {
			return false;
		}*/
	}
	
}
