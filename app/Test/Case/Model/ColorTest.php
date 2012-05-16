<?php
App::uses('Color', 'Model');

/**
 * Color Test Case
 *
 */
class ColorTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.color', 'app.card', 'app.stack', 'app.user', 'app.attachment', 'app.comment');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Color = ClassRegistry::init('Color');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Color);

		parent::tearDown();
	}

}
