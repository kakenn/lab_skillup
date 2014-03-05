<?php
App::uses('AppModel', 'Model');
/**
 * Follow Model
 *
 * @property User $User
 */
class Follow extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'follow_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'follow_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
}
