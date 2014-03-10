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
	public function getTweets($id=null,$page=1){
		if($id!=null){
			App::import('Model','User');
			$user = new User;
			$res = $user->find('all',array(
				'conditions' => array('id' => $id)
			));
			if($res){
				$follow=array(array('user_id'=>$id));
				for($i=0;$i<count($res[0]['follow']);$i++){
					$follow[] = array('user_id'=>$res[0]['follow'][$i]['follow_id']);
				}
			}
			if(!empty($follow)){
				$result = $this->find('all',array(
					'conditions' => array('OR'=>$follow),
					'order' => array('Tweet.created DESC'),
					'limit' => 10,
					'page' => $page,
				));
				$count = $this->find('count',array(
					'conditions' => array('OR'=>$follow),
				));
			}
			$next=false;
			if($count>$page*10){
				$next=true;
			}
			$prev=false;
			if($page>1){
				$prev=true;
			}
			return array('res'=>$result,'count'=>$count,'next'=>$next,'prev'=>$prev);
		}
	}
	public function getUserTweets($username=null,$page=1){
		$result=false;
		if($username!=null){
			$result = $this->find('all',array(
					'conditions' => array(
						'username'=>$username,
					),
					'order' => array('Tweet.created DESC'),
					'limit' => 10,
					'page' => $page,
			));
		}
		return $result;
	}
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
