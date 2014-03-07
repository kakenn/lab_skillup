<?php
App::uses('AppModel', 'Model');
class Tweet extends AppModel {
	public $displayField = 'user_id';
	public $validate = array(
		'text' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '入力は必須です。',
			),
			'mb_maxLength' => array(
				'rule' => array('mb_maxLength','140'),
				'message' => '140文字以下にしてください。',
			),
		),
		'url' => array(
			'url' => array(
				'rule' => array('url'),
			),
		),
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	);


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
