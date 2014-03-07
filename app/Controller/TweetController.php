<?php
class TweetController extends AppController {
	public $uses = array('User','Tweet');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index(){
		if($this->request->isPost()){
			if(!empty($this->request->data['Tweet']['text'])){
				if($this->Tweet->save($this->request->data)){
					$this->Session->setFlash('ツイートされました。');
				} else {
					$this->Session->setFlash(__('入力に誤りがあります。'));
				}
			}
		}
	}
}