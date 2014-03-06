<?php
class IndexController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','signup'));
	}
	public function index(){

	}
	public function signup(){

	}
}