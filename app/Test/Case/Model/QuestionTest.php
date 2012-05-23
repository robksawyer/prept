<?php
App::uses('Question', 'Model');

/**
 * Question Test Case
 *
 */
class QuestionTestCase extends CakeTestCase {
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
		$this->Question = ClassRegistry::init('Question');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Question);

		parent::tearDown();
	}

}
