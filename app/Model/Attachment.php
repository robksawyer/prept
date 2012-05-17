<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 * @property User $User
 * @property User $User
 */
class Attachment extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	public $actsAs = array(
		'Utils.Sluggable' => array(
			'label' => 'name',
			'method' => 'multibyteSlug'
		),
		'Uploader.FileValidation' => array(
			'fileName' => array(
						'required'	=> array(
										'value' => true,
										'error' => 'You must select a file first'
						),
						'extension'	=> array( //Only allow images
								'value' => array(
									'aif','aifc','aiff','au','kar','mid','midi','mp2','mp3',
									'mpga','ra','ram','rm','rpm','snd','tsi','wav','m4a','m4b','m4p',
									'wma','gz','gtar','z','tgz','zip','rar','rev','tar','7z'
								),
								'error' => 'You cannot upload this type of file.'
						)
						/*'filesize' => array(
										'value' => 5242880,
										'error' => 'This file is too large or small.'
						)*/
					)
		)
	);
		
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'attachment_id',
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
