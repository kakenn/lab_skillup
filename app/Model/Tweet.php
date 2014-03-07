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
	public function beforeSave($options = array()) {

		//現在時刻を代入
		$dt = new DateTime();
		$this->data[$this->alias]['created'] =  $dt->format('Y-m-d H:i:s');
		preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)',$this->data[$this->alias]['text'],$arr);

		//一つ目だけ保存。
		if(0!=count($arr)){
			$this->data[$this->alias]['url']=$arr[0];
		}
		return true;
	}
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			//'fields' => '',
			//'order' => ''
		)
	);
}
