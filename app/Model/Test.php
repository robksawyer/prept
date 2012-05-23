<?php
App::uses('AppModel', 'Model');
/**
 * Test Model
 *
 * @property Stack $Stack
 * @property User $User
 * @property Question $Question
 */
class Test extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	//http://cakedc.com/eng/downloads/view/cakephp_tags_plugin
	public $actsAs = array('Containable','Tags.Taggable','Search.Searchable');
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Stack' => array(
			'className' => 'Stack',
			'foreignKey' => 'stack_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'test_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
