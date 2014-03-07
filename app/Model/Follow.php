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
			'fields' => '',
			'order' => ''
		)
	);
}
