<h1>いまなにしてる</h1>
<div id="userInfo">
	<h2><?php echo $userInfo['User']['username']; ?></h2>
	<table>
		<tr>
			<td><?php echo count($userInfo['Connection']['follow']) ?></td>
			<td><?php echo count($userInfo['Connection']['follower']) ?></td>
			<td><?php echo $userInfo['Connection']['count'] ?></td>
		</tr>
		<tr>
			<th><?php echo $this->Html->link('フォローしている',array('controller'=>'user','action'=>'follow','id'=>$user['username'])) ?></th>
			<th><?php echo $this->Html->link('フォローされている',array('controller'=>'user','action'=>'follower','id'=>$user['username'])) ?></th>
			<th><?php echo $this->Html->link('投稿',array('controller'=>'user','action'=>'index','id'=>$user['username'])) ?></th>
		</tr>
	</table>
</div>
<?php echo $this->Html->script('script'); ?>
<?php echo $this->Form->create('Tweet'); ?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->error('text'); ?>
<?php echo $this->Form->textarea('text',array('label'=>false,'id'=>'tweetBox')); ?>
<div id="submitBox">
	<p>残り<span id="strNum">140</span>文字</p>
	<?php echo $this->Form->submit('ツイート',array('id'=>'tweetBtn')); ?>
</div>
<?php echo $this->Form->end(); ?>
<?php if(isset($userInfo['Tweet'][0])): ?>
<div id="newTweet">
	<h2>最新ツイート</h2>
	<p class="text">
		<?php echo $userInfo['Tweet'][0]['text']; ?>
	</p>
	<p class="date">
		<?php echo date('Y年m月d日H時i分s秒',strtotime($userInfo['Tweet'][0]['created'])) ?>
	</p>
</div>
<?php endif; ?>
<hr>
<ul id="tweetList">
	<?php foreach ($tweetData['res'] as $value) : ?>
		<li>
			<dl>
				<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index','id' => $value['User']['username'])); ?></dt>
				<dd><?php echo str_replace("\n",'<br>',$value['Tweet']['text']) ?></dd>
			</dl>
			<p class="date"><?php echo date('Y年m月d日H時i分s秒',strtotime($value['Tweet']['created'])) ?></p>
			<?php if($value['User']['id']==$user['id']) echo $this->form->postLink('削除',array('action'=>'delete', $value['Tweet']['id']),array('class'=>'delBtn'),'削除しますか？'); ?>
		</li>
	<?php endforeach; ?>
</ul>
<div id="page" class="cf">
	<?php
	if($tweetData['next']){
		echo $this->Html->link('次のページへ',array('action'=>'index',$page+1));
	}
	if($tweetData['prev']){
		echo $this->Html->link('前のページへ',array('action'=>'index',$page-1));
	}
	?>
</div>