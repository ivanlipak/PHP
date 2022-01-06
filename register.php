<?php 
	print '
	<h1>Registracija</h1>
	<div id="register">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="fname">Ime *</label>
			<input type="text" id="fname" name="firstname" placeholder="Ime..." required>
			<label for="lname">Prezime *</label>
			<input type="text" id="lname" name="lastname" placeholder="Prezime..." required>
				
			<label for="email">E-mail *</label>
			<input type="email" id="email" name="email" placeholder="E-mail..." required>
			
			<label for="username">Korisničko ime:* <small>(Mora biti minimalno 5 i maksimalno 10 znakova)</small></label>
			<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Korisničko ime..." required><br>
			
									
			<label for="password">Lozinka:* <small>(Mora biti više od 4 znaka)</small></label>
			<input type="password" id="password" name="password" placeholder="Lozinka..." pattern=".{4,}" required>
			<label for="country">Država:</label>
			<select name="country" id="country">
				<option value="">Odaberite</option>';
				
				$query  = "SELECT * FROM countries";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
				}
			print '

			</select>

			<label for="fgrad">Grad *</label>
			<input type="text" id="fgrad" name="grad" placeholder="Grad..." required>

			<label for="fulica">Ulica i broj: *</label>
			<input type="text" id="fulica" name="ulica" placeholder="Ulica..." required>

			<label for="fdate">Datum Rođenja: *</label>
			<input style="width:50%" type="date" id="fdate" name="datumrodenja" value="mm/dd/yyyy">

			<br><br>

			<input type="submit" value="Registriraj se">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($row['email'] == '' || $row['username'] == '') {
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (firstname, lastname, email, username, password, country, grad, ulica, datumrodenja )";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "', '" . $_POST['grad'] . "', '" . $_POST['ulica'] . "', '" . $_POST['datumrodenja'] . "')";
			$result = @mysqli_query($MySQL, $query);
			

			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', thank you for registration </p>
			<hr>';
		}
		else {
			echo '<p> Već postoji korisnik s ovim e-mailom! </p>';
		}
	}
	print '
	</div>';
?>