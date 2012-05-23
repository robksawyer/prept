<?php
App::uses('Test', 'Model');

/**
 * Test Test Case
 *
 */
class TestTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.test', 'app.stack', 'app.color', 'app.card', 'app.user', 'app.attachment', 'app.comment', 'plugin.tags.tag', 'plugin.tags.tagged', 'app.question');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Test = ClassRegistry::init('Test');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Test);

		parent::tearDown();
	}

}
