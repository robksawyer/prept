<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'auto_login' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => '3'),
		'attachment_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'profile_image_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 65, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fullname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birthday' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'location' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'about' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gender' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'active' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
		'banned' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'hide_competitions' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'hide_welcome' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
		'signature' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'locale' => array('type' => 'string', 'null' => false, 'default' => 'eng', 'length' => 3, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'timezone' => array('type' => 'string', 'null' => false, 'default' => '-8', 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_on_like' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email_on_comment' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'notify_on_follow' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'notify_on_like' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'totalLikes' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'staff_favorite' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'facebook_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'twitter_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'public_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'currentLogin' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'lastLogin' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'slug' => array('column' => 'slug', 'unique' => 1), 'email' => array('column' => 'email', 'unique' => 1)),
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
			'auto_login' => 1,
			'role_id' => 1,
			'attachment_id' => 1,
			'profile_image_url' => 'Lorem ipsum dolor sit amet',
			'username' => 'Lorem ipsum dolor sit amet',
			'fullname' => 'Lorem ipsum dolor sit amet',
			'birthday' => '2012-05-16',
			'url' => 'Lorem ipsum dolor sit amet',
			'location' => 'Lorem ipsum dolor sit amet',
			'about' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'gender' => 'Lorem ip',
			'active' => 1,
			'banned' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'hide_competitions' => 1,
			'hide_welcome' => 1,
			'status' => 1,
			'signature' => 'Lorem ipsum dolor sit amet',
			'locale' => 'L',
			'timezone' => 'Lo',
			'email_on_like' => 1,
			'email_on_comment' => 1,
			'notify_on_follow' => 1,
			'notify_on_like' => 1,
			'totalLikes' => 1,
			'staff_favorite' => 1,
			'facebook_id' => 1,
			'twitter_id' => 1,
			'public_key' => 'Lorem ipsum dolor sit amet',
			'currentLogin' => '2012-05-16 14:09:31',
			'lastLogin' => '2012-05-16 14:09:31',
			'created' => '2012-05-16 14:09:31',
			'modified' => '2012-05-16 14:09:31'
		),
	);
}
