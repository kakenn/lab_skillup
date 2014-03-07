<?php
App::uses('AppModel', 'Model');
/**
 * Follow Model
 *
 * @property User $User
 */
class Follow extends AppModel {
	public $primaryKey = 'follow_id';
	public $displayField = 'follow_id';


	public function beforeSave($options = array()) {

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
