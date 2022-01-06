<?php print'
<body>
	<main>
		<h1>Kontakt</h1>
		<div id="kontakt">
        <iframe height="588" width="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=Prekopa,%20GLina&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            <p style="text-align:center; padding: 10px; background-color: #d7d6d6;border-radius: 5px;">Primili smo vaš upit. Hvala!</p>';
				$EmailHeaders  = "MIME-Version: 1.0\r\n";
				$EmailHeaders .= "Content-type: text/html; charset=utf-8\r\n";
				$EmailHeaders .= "From: ilipak@vvg.hr>\r\n";
				$EmailHeaders .= "Reply-To:<ilipak@vvg.hr>\r\n";
				$EmailHeaders .= "X-Mailer: PHP/".phpversion();
				$EmailSubject = 'Example page - Contact Form';
				$EmailBody  = '
				<html>
				<head>
				   <title>'.$EmailSubject.'</title>
				   <style>
					body {
					  background-color: #ffffff;
						font-family: Arial, Helvetica, sans-serif;
						font-size: 16px;
						padding: 0px;
						margin: 0px auto;
						width: 500px;
						color: #000000;
					}
					p {
						font-size: 14px;
					}
					a {
						color: #00bad6;
						text-decoration: underline;
						font-size: 14px;
					}
					
				   </style>
				   </head>
				<body>
					<p>First name: ' . $_POST['firstname'] . '</p>
					<p>Last name: ' . $_POST['lastname'] . '</p>
					<p>E-mail: <a href="mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a></p>
					<p>Country: ' . $_POST['country'] . '</p>
					<p>Subject: ' . $_POST['subject'] . '</p>
				</body>
				</html>';
				print '<p>Ime: ' . $_POST['firstname'] . '</p>
				<p>Prezime: ' . $_POST['lastname'] . '</p>
				<p>E-mail: ' . $_POST['email'] . '</p>
				<p>Država: ' . $_POST['country'] . '</p>
				<p>Upit: ' . $_POST['subject'] . '</p>';
                ini_set("SMTP","ssl:smtp.gmail.com" );
                ini_set("smtp_port","465");
                ini_set('sendmail_from', 'ilipak@vvg.hr');  
				mail($_POST['email'], $EmailSubject, $EmailBody, $EmailHeaders); print'
			?>
		</div>
	</main>';

print"
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-98455037-1', 'auto');
	  ga('send', 'pageview');

	</script>
";
