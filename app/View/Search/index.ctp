<h1>検索</h1>
<?php echo $this->Form->create('User',array('type'=>'GET')); ?>
<?php echo $this->Form->input('keyword',array('label'=>'検索','value'=>$word)); ?>
<?php echo $this->Form->submit('検索'); ?>
<?php echo $this->Form->end(); ?>
<?php
if($result===null){
	echo"検索してない";
}else if($result['user']===array()){
	echo "検索結果なし";
}else{ ?>
	<ul>
	<?php foreach ($result['user'] as $value) : ?>
		<?php if($value['User']['id']!=$user['id']): ?>
		<li>
		<dl>
			<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index',$value['User']['username']))?><?php echo $value['User']['username']; ?></dt>
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
		if(!$value['follow']){
			echo $this->form->postLink('follow',array('action'=>'follow', $value['User']['id']),array(),'フォローしますか？');
		}
		?>
		</li>
		<?php endif; ?>
	<?php endforeach;?>
	</ul>
<?php } ?>