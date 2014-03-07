<h1>いまなにしてる</h1>
<?php echo $this->Html->script('script'); ?>
<?php echo $this->Form->create('Tweet'); ?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->error('text'); ?>
<?php echo $this->Form->textarea('text',array('label'=>false,'id'=>'tweetBox')); ?>
<p>残り<span id="strNum">140</span>文字</p>
<?php echo $this->Form->submit('ツイート',array('id'=>'tweetBtn')); ?>
<?php echo $this->Form->end(); ?>
<ul id="tweetList">
	<?php foreach ($tweetData as $value) : ?>
		<li>
			<dl>
				<dt><a href="#"><?php echo $value['User']['viewname'] ?></a></dt>
				<dd><?php echo str_replace("\n",'<br>',$value['Tweet']['text']) ?></dd>
			</dl>
			<p class="date"><?php echo date('Y年m月d日H時i分s秒',strtotime($value['Tweet']['created'])) ?></p>
		</li>
	<?php endforeach; ?>
</ul>