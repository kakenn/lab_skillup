<?php
class UserController extends AppController {
	public $uses = array('User','Tweet');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index($username=null){
		if($username==null) $this->redirect(array('controller'=>'index','action'=>'index'));
		$tweetData = $this->Tweet->getUserTweets($username);
		$this->set('tweetData',$tweetData);
	}
}