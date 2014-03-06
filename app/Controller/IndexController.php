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
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('登録完了しました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('登録に失敗しました。再度お試しください。'));
			}
		}
	}
}