<h1>ログイン</h1>
<div id="signupBox">
	<h2 class="mb20">無料でサインアップしよう。</h2>
	<?php echo $this->Html->link('無料サインアップ',array('controller'=>'index','action'=>'signup'),array('class'=>'btn')); ?>
</div>
<div id="login" class="form">
	<?php echo $this->Form->create('User'); ?>
	<div class="dispErr">
		<?php echo $this->Session->flash(); ?><br>
		<?php
			echo $this->Form->error('username');
			echo $this->Form->error('password');
		?>
	</div>
	<?php echo $this->Form->input('username',array('error' => false,'label'=>'ユーザー名','id'=>'username')) ?>
	<?php echo $this->Form->input('password',array('error' => false,'label'=>'パスワード','id'=>'passwd')) ?>
	<?php echo $this->Form->submit('ログイン'); ?>
</div>
<?php echo $this->Form->end(); ?>