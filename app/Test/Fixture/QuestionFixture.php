<?php
/**
 * QuestionFixture
 *
 */
class QuestionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'card_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'time_elapsed' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'correct' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 1),
		'test_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'card_id' => 1,
			'time_elapsed' => 1,
			'correct' => 1,
			'test_id' => 1,
			'user_id' => 1,
			'created' => '2012-05-23 08:16:21',
			'modified' => '2012-05-23 08:16:21'
		),
	);
}
