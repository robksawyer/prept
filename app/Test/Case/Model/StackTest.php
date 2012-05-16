<?php
App::uses('Stack', 'Model');

/**
 * Stack Test Case
 *
 */
class StackTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.stack', 'app.color', 'app.user', 'app.attachment', 'app.card', 'app.comment');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stack = ClassRegistry::init('Stack');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stack);

		parent::tearDown();
	}

}
