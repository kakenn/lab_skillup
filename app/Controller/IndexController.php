<?php
class IndexController extends AppController {
	public $uses = array('User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','signup','userValidate'));
	}

	public function index(){
	}
	public function signup(){
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('登録完了しました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('入力に誤りがあります。'));
			}
		}
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