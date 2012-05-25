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
	 * This method handles updating the test with an answer to the question
	 *
	 * @param $test_id The id of the current test being taken
	 * @param $score Whether or not the user got it right or wrong
	 * @return void
	 * @author Rob Sawyer
	 **/
	public function answer(){
		if($this->RequestHandler->isAjax()){
			$this->autoRender = false;
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
			}
		}
	}
	
}
