<h1>ついったーに参加しました。</h1>
<p><?php echo $this->Session->flash(); ?>さんはついったーに参加されました。
ログインをクリックしてログインしつぶやいてください。<!-- ログインをしてつぶやいて下さい。 --></p>
<?php echo	 $this->Html->link("ついったーにログイン",array('controller'=>'login','action'=>'index')); ?>