<?php
class UserController extends AppController {
	public $uses = array('User','Tweet');
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function index(){
		$username = $this->request->params['id'];
		$page = (!empty($this->request->params['page']))? $this->request->params['page'] : 1;
		$userID = $this->User->getID($username);

		if(!is_numeric($page)) $page = 1;
		if(empty($username)) parent::gotoTop();

		$tweetData = $this->Tweet->getUserTweets($username,$page);

		$userInfo = $this->User->getUser($userID);
		$userInfo['Connection'] = $this->User->getConnection($userID);

		$this->set('userInfo',$userInfo);
		$this->set('tweetData',$tweetData);
		$this->set('page',$page);
	}

	public function follow(){

		$username = $this->request->params['id'];
		$page = (!empty($this->request->params['page']))? $this->request->params['page'] : 1;
		$userID = $this->User->getID($username);

		if(!is_numeric($page)) $page = 1;
		if(empty($username)) parent::gotoTop();

		$userInfo = $this->User->getUser($userID);
		$userInfo['Connection'] = $this->User->getConnection($userID);
		foreach ($userInfo['Connection']['follow'] as $key => $value) {
			$userInfo['Connection']['follow'][$key]['flag'] = $this->User->isFollow($this->Auth->user('id'),$value['User']['id']);
			$userInfo['Connection']['follow'][$key]['follow'] = $this->User->getUser($value['User']['id']);
		}
		$this->set('userInfo',$userInfo);
		$this->set('page',$page);
	}

	public function follower(){

		$username = $this->request->params['id'];
		$page = (!empty($this->request->params['page']))? $this->request->params['page'] : 1;
		$userID = $this->User->getID($username);

		if(!is_numeric($page)) $page = 1;
		if(empty($username)) parent::gotoTop();

		$userInfo = $this->User->getUser($userID);
		$userInfo['Connection'] = $this->User->getConnection($userID);
		foreach ($userInfo['Connection']['follower'] as $key => $value) {
			$userInfo['Connection']['follower'][$key]['flag'] = $this->User->isFollow($this->Auth->user('id'),$value['Follow']['user_id']);
			$userInfo['Connection']['follower'][$key]['follower'] = $this->User->getUser($value['Follow']['user_id']);
		}
		$this->set('userInfo',$userInfo);
		$this->set('page',$page);
	}
}