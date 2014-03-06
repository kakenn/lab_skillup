<?php
class IndexController extends AppController {
	public $uses = array('User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','signup','signupFinish','userValidate'));
	}

	public function index(){
	}
	public function signup(){
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash($this->request->data['User']['viewname']);
				$this->redirect(array('action' => 'signupFinish'));
			} else {
				$this->Session->setFlash(__('入力に誤りがあります。'));
			}
		}
	}
	public function signupFinish(){
	}
	public function uservalidate(){
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$count = $this->User->find('count',array(
				'conditions' => array('username' => $this->request->data['username'])
			));
			if($count==0){
				echo "true";
				return false;
			}
		}
		echo "false";
	}
}