<?php
App::uses('AppModel', 'Model');
/**
 * Stack Model
 *
 * @property Color $Color
 * @property User $User
 * @property Card $Card
 */
class Stack extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
	
	//http://cakedc.com/eng/downloads/view/cakephp_tags_plugin
	public $actsAs = array('Containable','Tags.Taggable','Search.Searchable');
	
	public $filterArgs = array(
		array('name' => 'title', 'type' => 'like'),
		array('name' => 'description', 'type' => 'like'),
		//array('name' => 'user_id', 'type' => 'value'),
		array('name' => 'color_id', 'type' => 'value'),
		array('name' => 'tags', 'type' => 'subquery', 'method' => 'findByTags', 'field' => 'Stack.id'),
		array('name' => 'filter_and', 'type' => 'query', 'method' => 'andConditions'),
		array('name' => 'filter_or', 'type' => 'query', 'method' => 'orConditions')
	);
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must enter a title.',
				'allowEmpty' => false,
				'required' => true
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Card' => array(
			'className' => 'Card',
			'foreignKey' => 'stack_id',
			'dependent' => true,
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

	public function findByTags($data = array()) {
		$this->Tagged->Behaviors->attach('Containable', array('autoFields' => false));
		$this->Tagged->Behaviors->attach('Search.Searchable');
		$query = $this->Tagged->getQuery('all', array(
			'conditions' => array('Tag.name'  => $data['tags']),
			'fields' => array('foreign_key'),
			'contain' => array('Tag')
		));
		return $query;
	}
	
	public function orConditions($data = array()) {
		if(empty($data['filter_or'])) return array();
		$orQuery = array();
		foreach($data['filter_or'] as $searchString){
			$tempString = array($this->alias.'.title LIKE' => '%'.$searchString.'%');
			array_push($orQuery,$tempString);
		}
		$cond = array(
			'OR' => $orQuery
			);
		return $cond;
	}
	
	public function andConditions($data = array()) {
		if(empty($data['filter_and'])) return array();
		$andQuery = array();
		foreach($data['filter_and'] as $searchString){
			$tempString = array($this->alias.'.title LIKE' => '%'.$searchString.'%');
			array_push($andQuery,$tempString);
		}
		$cond = array(
			'AND' => $andQuery
			);
		return $cond;
	}
}
