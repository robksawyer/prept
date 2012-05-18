<?php
App::uses('AppModel', 'Model');
/**
 * Card Model
 *
 * @property Stack $Stack
 * @property Color $Color
 * @property User $User
 */
class Card extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'front';
	
	//http://cakedc.com/eng/downloads/view/cakephp_tags_plugin
	public $actsAs = array('Tags.Taggable','Search.Searchable');
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'front' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'Color' => array(
			'className' => 'Color',
			'foreignKey' => 'color_id',
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
}
