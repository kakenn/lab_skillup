<?php
class SearchController extends AppController {
	public $uses = array('User','Follow');
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function index(){
		if(isset($this->request->query['page'])) $page = $this->request->query['page'];
		if(isset($this->request->query['keyword'])) $word = $this->request->query['keyword'];
		if(empty($page) || !is_numeric($page)){
			$page=1;
		}
		if(!empty($word)){
			$result = $this->User->searchUser($word,$page);
			foreach ($result['user'] as $key => $value) {
				$result['user'][$key]['follow'] = ($this->Follow->checkFollow($this->Auth->user('id'),$value['User']['id'])==1)? true : false;
			}
		}else{
			$word="";
			$result=null;
		}
		$this->set('word',$word);
		$this->set('result',$result);
	}
	public function follow($id=null){
		if($id==null || !is_numeric($id)) parent::gotoTop();
		$this->Follow->doFollow($this->Auth->user('id'),$id);
		$this->redirect($this->referer());
	}
}