<?php 
	
	$link = sha1('home_pe');
	if (isset($_GET[sha1('home_pe')])) {
		
		header("location:home_pe.php?$link");
    }
