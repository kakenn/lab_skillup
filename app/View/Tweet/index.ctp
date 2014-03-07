<h1>いまなにしてる</h1>
<?php echo $this->Form->create('Tweet'); ?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->error('text'); ?>
<?php echo $this->Form->textarea('text',array('label'=>false,'id'=>'tweetBox')); ?>
<p>残り<span id="strNum">140</span>文字</p>
<?php echo $this->Form->submit('ツイート',array('id'=>'tweetBtn')); ?>
<?php echo $this->Form->end(); ?>