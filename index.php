<?php 
	define('__APP__', TRUE);
    session_start();
	include ("dbconn.php");
    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
	if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }
    if(!isset($_POST['_action_']))  
		{ $_POST['_action_'] = FALSE;  }
	if (!isset($menu)) 
		{ $menu = 1; }
    include_once("functions.php");

print '
<!DOCTYPE html>
<html>
	<head>
		<!DOCTYPE html>
		<html lang="hr">
		<meta charset="UTF-8">
		<title>Obiteljsko poljoprivredno gospodarstvo</title>
		<meta name="author" content="Ivan Lipak">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
		<title>OPG</title>
	</head>
<body>
	<header>
		<nav>';
			include("menu.php");
			print'
		</nav>
		<div'; 
		switch ($menu) {
			case 1:print ' class="hero-image"';
				break;
			case 2:print ' class="hero-image2"';
				break;
			case 3:print ' class="hero-image2"';
				break;
			case 4:print ' class="hero-image2"';
				break;
			case 5:print ' class="hero-image2"';
				break;
			case 6:print ' class="hero-image2"';
				break;
			case 7:print ' class="hero-image2"';
				break;
			default: print ' class="hero-image"';
		}print '></div>
	</header>
	<main>';
		#Što otvoriti
		if (!isset($_GET['menu']) || $_GET['menu'] == 1) 
			{ include("main.php"); }
		else if ($_GET['menu'] == 2) 
			{ include("news.php"); }
		else if ($_GET['menu'] == 3) 
			{ include("contact.php"); }
		else if ($_GET['menu'] == 4) 
			{ include("about.php"); }
		else if ($_GET['menu'] == 5) 
			{ include("register.php"); }
		else if ($_GET['menu'] == 6) 
			{ include("signin.php"); }
		else if ($_GET['menu'] == 7) 
			{ include("admin.php"); }
		else if ($_GET['menu'] == 9) 
			{ include("mailsend.php"); }
		else if ($_GET['menu'] == 10) 
			{ include("gallery.php"); }
		print '
		</br>
	</main>
	<footer>
		<p>Copyright &copy; ' . date("Y") . ' Ivan Lipak. <a href="https://github.com/ivanlipak"><img style="width: 15px;" src="images/git.png" title="Github" alt="Github"></a></p>
	</footer>
</body>
</html>';
?>