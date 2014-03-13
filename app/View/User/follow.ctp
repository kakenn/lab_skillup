<div id="userInfo">
	<h2><?php echo $userInfo['User']['username']; ?></h2>
	<h3><?php echo $this->Html->link('フォローしている',array('action'=>'follow','id'=>$userInfo['User']['username'])) ?></h3>
	<p class="follow"><?php echo count($userInfo['Connection']['follow']) ?></p>
	<h3><?php echo $this->Html->link('フォローされている',array('action'=>'follower','id'=>$userInfo['User']['username'])) ?></h3>
	<p class="follower"><?php echo count($userInfo['Connection']['follower']) ?></p>
	<h3>投稿</h3>
	<p class="follower"><?php echo $userInfo['Connection']['count'] ?></p>
</div>
<ul>
<?php foreach ($userInfo['Connection']['follow'] as $key => $value) : ?>
	<?php if($key < $page*10 && ($page-1)*10 <= $key): ?>
	<li>
	<dl>
		<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index','id'=>$value['User']['username']))?><?php echo $value['User']['username']; ?></dt>
		<dd><?php
		if(!empty($value['follow']['Tweet'])){
			echo str_replace("\n",'<br>',$value['follow']['Tweet'][0]['text']);
		}
		?></dd>
	</dl>
	<p class="date"><?php
	if(!empty($value['follow']['Tweet'])){
		echo date('Y年m月d日H時i分s秒',strtotime($value['follow']['Tweet'][0]['created']));
	}
	?></p>
	<?php
	if(!$value['flag']){
		echo $this->form->postLink('follow',array('controller'=>'search','action'=>'follow', $value['User']['id']),array(),'フォローしますか？');
	}else{
		echo $this->form->postLink('unfollow',array('controller'=>'search','action'=>'unfollow', $value['User']['id']),array(),'フォローをやめますか？');
	}
	?>
	</li>
	<?php endif;?>
<?php endforeach;?>
</ul>
<div id="page">
	<?php
	if(count($userInfo['Connection']['follow']) > $page*10){
		echo $this->Html->link('次のページへ',array('action'=>'index','id'=>$userInfo['User']['username'],'page'=>$page+1));
	}
	if($page > 1){
		echo $this->Html->link('前のページへ',array('action'=>'index','id'=>$userInfo['User']['username'],'page'=>$page-1));
	}
	?>
</div>