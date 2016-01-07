<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Erro 404</title>
	<link href="<?=base_url('public/css/style.css')?>" rel="stylesheet" />
	<script src="<?=base_url('public/js/jquery.js')?>"></script>
	<script src="<?=base_url('public/js/script.js')?>"></script>
</head>
<body>
	<?php if(isset($me)):?>
	<nav>
		<h1><a href="<?=base_url('')?>">scrapbook</a></h1>
		<ul>
			<li name="userName" >
				<?=anchor($me->username,'<i class="fa fa-user"></i>'.$me->firstname.' '.$me->lastname)?>
			</li>
			<li><a href="signout"><i class="fa fa-times"></i>SignOut</a></li>
		</ul>
	</nav>
	<?php endif;?>
<main>
	<div class="page-error" style="background: url(<?=base_url('public/img/404.png')?>)">
		<div class="top">
			<h1>404-Not Found</h1>
		</div>
		<p style="text-align: center; to"><a href="<?=base_url('')?>">Clique aqui</a> para ir para a página inicial</p>
	</div>
</main>
<footer>
	</footer>
</body>
</html>