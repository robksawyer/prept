<?php
App::uses('QuestionsController', 'Controller');

/**
 * TestQuestionsController *
 */
class TestQuestionsController extends QuestionsController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * QuestionsController Test Case
 *
 */
class QuestionsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.question', 'app.card', 'app.stack', 'app.color', 'app.user', 'app.attachment', 'app.comment', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.test');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Questions = new TestQuestionsController();
		$this->Questions->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Questions);

		parent::tearDown();
	}

}
