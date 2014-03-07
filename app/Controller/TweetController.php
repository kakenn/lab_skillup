<?php
class TweetController extends AppController {
	public $uses = array('User','Tweet');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index(){
		//ツイートの部分の処理
		if($this->request->isPost()){
			if(!empty($this->request->data['Tweet']['text'])){
				$this->request->data['Tweet']['user_id']=$this->Auth->user('id');
				if($this->Tweet->save($this->request->data)){
					$this->Session->setFlash('ツイートされました。');
				} else {
					$this->Session->setFlash(__('入力に誤りがあります。'));
				}
			}
		}

		//ツイート表示部分の処理
		$tweetData = $this->Tweet->getTweets($this->Auth->user('id'));
		//debug($tweetData);
		$this->set('tweetData',$tweetData);
	}
}