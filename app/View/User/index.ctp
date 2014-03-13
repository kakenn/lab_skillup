<h1><?php echo $userInfo['User']['username']; ?>さんのツイート</h1>
<div id="userInfo">
	<h2><?php echo $userInfo['User']['username']; ?></h2>
	<table>
		<tr>
			<td><?php echo count($userInfo['Connection']['follow']) ?></td>
			<td><?php echo count($userInfo['Connection']['follower']) ?></td>
			<td><?php echo $userInfo['Connection']['count'] ?></td>
		</tr>
		<tr>
			<th><?php echo $this->Html->link('フォローしている',array('controller'=>'user','action'=>'follow','id'=>$userInfo['User']['username'])) ?></th>
			<th><?php echo $this->Html->link('フォローされている',array('controller'=>'user','action'=>'follower','id'=>$userInfo['User']['username'])) ?></th>
			<th><?php echo $this->Html->link('投稿',array('controller'=>'user','action'=>'index','id'=>$userInfo['User']['username'])) ?></th>
		</tr>
	</table>
</div>
<ul id="tweetList">
	<?php foreach ($tweetData['res'] as $value) : ?>
		<li>
			<dl>
				<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index','id' => $value['User']['username'])); ?></dt>
				<dd><?php echo str_replace("\n",'<br>',$value['Tweet']['text']) ?></dd>
			</dl>
			<p class="date"><?php echo date('Y年m月d日H時i分s秒',strtotime($value['Tweet']['created'])) ?></p>
			<?php if($value['User']['id']==$user['id']) echo $this->form->postLink('削除',array('controller'=>'tweet','action'=>'delete', $value['Tweet']['id']),array('class'=>'delBtn'),'削除しますか？'); ?>
		</li>
	<?php endforeach; ?>
</ul>
<div id="page" class="cf">
	<?php
	if($tweetData['next']){
		echo $this->Html->link('次のページへ',array('action'=>'index','id'=>$userInfo['User']['username'],'page'=>$page+1));
	}
	if($tweetData['prev']){
		echo $this->Html->link('前のページへ',array('action'=>'index','id'=>$userInfo['User']['username'],'page'=>$page-1));
	}
	?>
</div>