<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {
	public $name = 'User';
	public $hasMany = array(
		'Follow' => array(
			'className' => 'Follow',
			'foreignKey' => 'user_id',
			'order' => 'follow.follow_id DESC',
			'dependent' => true,
		),
		'Tweet' => array(
			'className' => 'Tweet',
			'foreignKey' => 'user_id',
			'order' => 'tweet.created DESC',
			'dependent' => true,
			'limit' => 1
		)
	);
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'ユーザー名を入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'そのユーザー名はすでに登録されています。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'ユーザー名は半角英数字で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
				'rule' => array('between',4, 20),
				'message' => 'ユーザー名は4文字以上,20文字以下で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'パスワードを入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'パスワードは半角英数字で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
				'rule' => array('between',4, 8),
				'message' => 'パスワード4文字以上,8文字以下で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'viewname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '名前を入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'usernameCheck' => array(
				'rule' => array('usernameCheck'),
				'message' => '名前は全角、又は半角英数字(記号は _ と - が使えます)で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'mb_between' => array(
				'rule' => array('mb_between','4','20'),
				'message' => '名前は4文字以上、20文字以下で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mail' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'メールアドレスに間違いがあります。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'メールアドレスを入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength','100'),
				'message' => 'メールアドレスは100文字以下で入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	public function usernameCheck($data) {
		$data = array_values($data);
		$data = $data[0];
		return preg_match('/^([^\x01-\x7E]|[a-zA-Z0-9-_])+$/', $data);
	}
	public function getID($username=null) {
		if(is_null($username)) return false;
		if($res = $this->find('first',array(
			'conditions' => array(
				'username'=>$username,
			),
		))){
			return $res['User']['id'];
		}else{
			return false;
		}
	}
	public function getUser($id=null) {
		if(is_null($id)) return falase;
		return $this->find('first',array(
			'conditions' => array(
				'id'=>$id,
			),
		));
	}
	public function getConnection($id=null) {
		if(is_null($id)) return falase;

		App::import('Model','Follow');
		$follow = new Follow;
		$res_follow = $follow->find('all',array(
			'conditions' => array(
				'user_id' => $id,
			)
		));
		$res_follower = $follow->find('all',array(
			'conditions' => array(
				'follow_id' => $id,
			)
		));

		App::import('Model','Tweet');
		$Tweet = new Tweet;
		$count = $Tweet->find('count',array(
			'conditions' => array(
				'user_id' => $id,
			),
		));

		return array('follow' => $res_follow,'follower' => $res_follower,'count'=>$count);
	}
	public function isFollow($user_id=null,$follow_id=null) {
		if(is_null($user_id) || is_null($follow_id) || $user_id==$follow_id) return false;
		App::import('Model','Follow');
		$Follow = new Follow;
		$count = $Follow->find('count',array(
			'conditions' => array(
				'user_id' => $user_id,
				'follow_id' => $follow_id
			)
		));
		return ($count>0)? true : false;
	}
	public function searchUser($keyword=null,$page=1) {
		if(is_null($keyword)) return falase;
		$user = $this->find('all',array(
			'conditions' => array(
				'or' => array(
					array('username like'=>'%'.$keyword.'%'),
					array('viewname like'=>'%'.$keyword.'%'),
				),
			),
			'order' => array('User.created DESC'),
			'limit' => 10,
			'page' => $page,
		));
		$count = $this->find('count',array(
			'conditions' => array(
				'or' => array(
					array('username like'=>'%'.$keyword.'%'),
					array('viewname like'=>'%'.$keyword.'%'),
				),
			)
		));
		$next = ($count>$page*10)? true : false;
		$prev = ($page>1)? true : false;
		return array('user'=>$user,'next'=>$next,'prev'=>$prev);
	}
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
}
