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
<?php foreach ($userInfo['Connection']['follow'] as $value) : ?>
	<li>
	<dl>
		<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index','id'=>$value['User']['username']))?><?php echo $value['User']['username']; ?></dt>
		<dd><?php
		if(!empty($value['tweet'])){
			echo str_replace("\n",'<br>',$value['tweet'][0]['text']);
		}
		?></dd>
	</dl>
	<p class="date"><?php
	if(!empty($value['tweet'])){
		echo date('Y年m月d日H時i分s秒',strtotime($value['tweet'][0]['created']));
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
<?php endforeach;?>
</ul>