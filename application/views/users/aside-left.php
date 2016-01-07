<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside id="userDetail">
	<?php
	//letras
	$f = substr($user->firstname,0,1);
	$f = ucwords($f);
	$l = substr($user->lastname,0,1);
	$l = ucwords($l);
	?>
	<div class="userThumb" style="background: <?php if(isset($colorUserThumb[$f]))echo $colorUserThumb[$f];?>">
		<?php echo $f.$l?>
	</div>
	<div class="organizerText">
		<ul>
			<li class="userName" >
				<?=anchor(str_replace('@', '', $user->username),'<i class="fa fa-user"></i> '.$user->firstname.' '.$user->lastname)?>
			</li>
			<hr>
			<li class="userEmail">
				<i class="fa fa-envelope"></i> <?=$user->email?>
			</li>
		</ul>
	</div>
	<footer style="position: ;bottom: 20px">
		<p>&copy;Copyright 2015</p>
		<p>Todos os direiros reservados</p>
		<ul>
			<li><a href="francinildo">Francinildo Alves</a></li>
			<li><a href="sousajoaoneto">João Sousa</a></li>
			<li>Victor Leal</li>
		</ul>
	</footer>
</aside>
