<h1>検索</h1>
<?php echo $this->Form->create('User',array('type'=>'GET')); ?>
<?php echo $this->Form->input('keyword',array('label'=>'検索','value'=>$word)); ?>
<?php echo $this->Form->submit('検索'); ?>
<?php echo $this->Form->end(); ?>
<ul id="tweetList">
<?php
if($result===null){
}else if($result['user']===array()){
	echo "検索結果がありません";
}else{ ?>
<?php foreach ($result['user'] as $value) : ?>
	<?php if($value['User']['id']!=$user['id']): ?>
	<li>
	<dl>
		<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index','id'=>$value['User']['username']))?><?php //echo $value['User']['username']; ?></dt>
		<dd><?php
		if(!empty($value['Tweet'])){
			echo str_replace("\n",'<br>',$value['Tweet'][0]['text']);
		}
		?></dd>
	</dl>
	<p class="date"><?php
	if(!empty($value['Tweet'])){
		echo date('Y年m月d日H時i分s秒',strtotime($value['Tweet'][0]['created']));
	}
	?></p>
	<?php
	if(!$value['follow']){
		echo $this->form->postLink('follow',array('action'=>'follow', $value['User']['id']),array('class'=>'delBtn'),'フォローしますか？');
	}else{
		echo $this->form->postLink('unfollow',array('action'=>'unfollow', $value['User']['id']),array('class'=>'delBtn'),'フォローをやめますか？');
	}
	?>
	</li>
	<?php endif; ?>
<?php endforeach;?>
</ul>
<?php } ?>
<div id="page" class="cf">
	<?php
	if($result['next']){
		echo $this->Html->link('次のページへ','./?keyword='.$word.'&page='.($page+1));
	}
	if($result['prev']){
		echo $this->Html->link('前のページへ','./?keyword='.$word.'&page='.($page-1));
	}
	?>
</div>