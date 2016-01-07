<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php if(isset($page_title)) echo $page_title;?></title>
	<link href="<?=base_url('public/css/style.css')?>" rel="stylesheet" />
	<script src="<?=base_url('public/js/jquery.js')?>"></script>
	<script src="<?=base_url('public/js/script.js')?>"></script>
</head>
<body>
	<nav>
		<h1><a href="<?=base_url('')?>">scrapbook</a></h1>
		<ul>
			<li name="userName" >
				<?=anchor(str_replace('@', '', $me->username),'<i class="fa fa-user"></i> '.$me->firstname)?>
			</li>
			<li><a href="signout"><i class="fa fa-times"></i> Sair</a></li>
		</ul>
	</nav>