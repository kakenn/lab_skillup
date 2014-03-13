<h1>サインアップ</h1>
<div id="signupBox">
	<h2 class="mb20">もうツイッターに登録していますか？</h2>
	<?php echo $this->Html->link('ログイン',array('controller'=>'index','action'=>'signup')); ?>
</div>
<div id="signup" class="form">
	<?php echo $this->Html->script('validation'); ?>
	<?php echo $this->Form->create('User'); ?>
	<div class="dispErr">
		<?php echo $this->Session->flash(); ?><br>
		<?php
			echo $this->Form->error('viewname');
			echo $this->Form->error('username');
			echo $this->Form->error('password');
			echo $this->Form->error('password_cf');
			echo $this->Form->error('mail');
		?>
	</div>
	<?php echo $this->Form->input('viewname',array('error' => false,'label'=>'名前')) ?>
	<?php echo $this->Form->input('username',array('error' => false,'label'=>'ユーザー名','id'=>'username')) ?>
	<?php echo $this->Form->input('password',array('error' => false,'label'=>'パスワード','id'=>'passwd')) ?>
	<?php echo $this->Form->input('password_cf',array('error' => false,'type'=>'password','label'=>'パスワード(確認)')) ?>
	<?php echo $this->Form->input('mail',array('error' => false,'type'=>'email','label'=>'メールアドレス')) ?>
	<?php echo $this->Form->input('public',array('error' => false,'type'=>'checkbox','label'=>'つぶやきを非公開にする')) ?>
	<?php echo $this->Form->submit('アカウントを作成する',array('class'=>'submitBtn disabled','disabled'=>true)); ?>
</div>
<?php echo $this->Form->end(); ?>