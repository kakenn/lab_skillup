<?php
class IndexController extends AppController {
	public $used = array('User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','signup'));
	}

	public function index(){
	}
	public function signup(){
	}
}