<?php
class TweetController extends AppController {
	public $uses = array('User','Tweet');
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function index($page=1){
		//ページが数字かどうか。
		$this->pageNumeric($page);

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
		//$userInfo = $this->User->getUser($this->Auth->user('id'));
		$tweetData = $this->Tweet->getTweets($this->Auth->user('id'),$page);
		$this->set('tweetData',$tweetData);
		$this->set('page',$page);
	}
	public function delete($id=null){
		if($id!=null){

		}
	}
	private function pageNumeric($page){
		if(!is_numeric($page)) return 1;
		return $page;
	}
}