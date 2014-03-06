<h1>サインアップ</h1>
<div id="signup">
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('viewname',array('label'=>'名前')) ?>
<?php echo $this->Form->input('username',array('label'=>'ユーザー名')) ?>
<?php echo $this->Form->input('password',array('label'=>'パスワード')) ?>
<?php echo $this->Form->input('password_cf',array('type'=>'password','label'=>'パスワード(確認)')) ?>
<?php echo $this->Form->input('mail',array('type'=>'email','label'=>'メールアドレス')) ?>
<?php echo $this->Form->submit('アカウントを作成する'); ?>
<?php echo $this->Form->end(); ?>
</div>