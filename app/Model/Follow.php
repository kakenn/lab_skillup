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


	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function doFollow($user_id=null,$follow_id=null){
		if($user_id!=null && is_numeric($user_id) && $follow_id!=null && is_numeric($follow_id)){
			if($user_id!=$follow_id){
				return $this->save(array(
					'user_id' => $user_id,
					'follow_id' => $follow_id,
				));
			}
		}
		return false;
	}
	public function checkFollow($user_id=null,$follow_id=null){
		if($user_id!=null && is_numeric($user_id) && $follow_id!=null && is_numeric($follow_id)){
			if($user_id!=$follow_id){
				return $this->find('count',array(
					'conditions' => array(
						'user_id' => $user_id,
						'follow_id' => $follow_id
					)
				));
			}
		}
		return false;
	}
}
