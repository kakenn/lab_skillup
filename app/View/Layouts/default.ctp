<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<script>
		var webroot = '<?php echo $this->Html->url('/', true); ?>';
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<?php
		echo $this->Html->script('jquery.validate.min');
		echo $this->Html->script('script');
		echo $this->Html->meta('icon');

		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<ul>
				<li><?php echo $this->Html->link('ホーム',array('controller'=>'index','action'=>'index'))?></li>
				<?php if($user): ?>
				<li><?php echo $this->Html->link('友達を検索',array('controller'=>'search','action'=>'index'))?></li>
				<li><?php echo $this->Html->link('ログアウト',array('controller'=>'login','action'=>'logout'))?></li>
				<?php else: ?>
				<li><?php echo $this->Html->link('ユーザー登録',array('controller'=>'index','action'=>'signup'))?></li>
				<li><?php echo $this->Html->link('ログイン',array('controller'=>'login','action'=>'index'))?></li>
				<?php endif; ?>
			</ul>
		</div>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
