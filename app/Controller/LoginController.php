<?php
class LoginController extends AppController {
	public $uses = array('User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','login','logout'));
	}

	public function index(){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->User->set($this->request->data);
				$this->User->validates( array( 'fieldList' => array( 'username', 'password')));
				$this->Session->setFlash(__('ユーザ名、パスワードの組み合わせが違うようです。'));
			}
		}
	}
}