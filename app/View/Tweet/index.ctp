<h1>いまなにしてる</h1>
<div id="userInfo">
	<h2><?php echo $userInfo['User']['username']; ?></h2>
	<h3><?php echo $this->Html->link('フォローしている',array('action'=>'follow')) ?></h3>
	<p class="follow"><?php echo count($userInfo['Connection']['follow']) ?></p>
	<h3><?php echo $this->Html->link('フォローされている',array('action'=>'follower')) ?></h3>
	<p class="follower"><?php echo count($userInfo['Connection']['follower']) ?></p>
	<h3>投稿</h3>
	<p class="follower"><?php echo $userInfo['Connection']['count'] ?></p>
</div>
<?php echo $this->Html->script('script'); ?>
<?php echo $this->Form->create('Tweet'); ?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->error('text'); ?>
<?php echo $this->Form->textarea('text',array('label'=>false,'id'=>'tweetBox')); ?>
<p>残り<span id="strNum">140</span>文字</p>
<?php echo $this->Form->submit('ツイート',array('id'=>'tweetBtn')); ?>
<?php echo $this->Form->end(); ?>
<div id="newTweet">
	<h2>最新ツイート</h2>
	<p class="text">
		<?php echo $userInfo['Tweet'][0]['text']; ?>
	</p>
	<p class="date">
		<?php echo date('Y年m月d日H時i分s秒',strtotime($userInfo['Tweet'][0]['created'])) ?>
	</p>
</div>
<hr>
<ul id="tweetList">
	<?php foreach ($tweetData['res'] as $value) : ?>
		<li>
			<dl>
				<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index',$value['User']['username'])); ?></dt>
				<dd><?php echo str_replace("\n",'<br>',$value['Tweet']['text']) ?></dd>
			</dl>
			<p class="date"><?php echo date('Y年m月d日H時i分s秒',strtotime($value['Tweet']['created'])) ?></p>
			<?php if($value['User']['id']==$user['id']) echo $this->form->postLink('削除',array('action'=>'delete', $value['Tweet']['id']),array(),'削除しますか？'); ?>
		</li>
	<?php endforeach; ?>
</ul>
<div id="page">
	<?php
	if($tweetData['next']){
		echo $this->Html->link('次のページへ',array('action'=>'index',$page+1));
	}
	if($tweetData['prev']){
		echo $this->Html->link('前のページへ',array('action'=>'index',$page-1));
	}
	?>
</div>