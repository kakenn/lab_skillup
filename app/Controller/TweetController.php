<?php
class TweetController extends AppController {
	public $uses = array('User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index(){
	}
}