<h1>ついったーに参加しました。</h1>
<p class="mb20"><?php echo $this->Session->flash(); ?>さんはついったーに参加されました。
ログインをクリックしてログインしつぶやいてください。<!-- ログインをしてつぶやいて下さい。 --></p>
<div class="tac">
<?php echo	 $this->Html->link("ついったーにログイン",array('controller'=>'login','action'=>'index'),array('class'=>'btn')); ?>
</div>