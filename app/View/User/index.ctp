<ul id="tweetList">
	<?php foreach ($tweetData as $value) : ?>
		<li>
			<dl>
				<dt><?php echo $this->Html->link($value['User']['viewname'],array('controller'=>'user','action'=>'index',$value['User']['username'])); ?></dt>
				<dd><?php echo str_replace("\n",'<br>',$value['Tweet']['text']) ?></dd>
			</dl>
			<p class="date"><?php echo date('Y年m月d日H時i分s秒',strtotime($value['Tweet']['created'])) ?></p>
		</li>
	<?php endforeach; ?>
</ul>
<div id="page">
	<?php
	/*
	if($tweetData['next']){
		echo $this->Html->link('次のページへ',array('action'=>'index',$page+1));
	}
	if($tweetData['prev']){
		echo $this->Html->link('前のページへ',array('action'=>'index',$page-1));
	}
	*/
	?>
</div>