<?php
echo'
	<main>
		<div id="kontakt">
			<iframe height="588" width="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=Prekopa,%20GLina&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
				<div class="login">
				<form action="index.php?menu=9" id="contact_form" name="contact_form" method="POST">
					<label style="padding-top: 10px" for="fname">Ime *</label>
					<input type="text" id="fname" name="firstname" placeholder="Ime..." required>
					
					<label for="lname">Prezime *</label>
					<input type="text" id="lname" name="lastname" placeholder="Prezime..." required>
						
					<label for="email">Vaš E-mail *</label>
					<input type="email" id="email" name="email" placeholder="Vaš e-mail..." required>
					<label for="country">Država</label>
					<select name="country" id="country">
						<option value="">Odaberite</option>';
						$query  = "SELECT * FROM countries";
						$result = @mysqli_query($MySQL, $query);
						while($row = @mysqli_fetch_array($result)) {
							print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
						}
					print'
					</select>
					<label for="subject">Upit</label>
					<textarea id="subject" name="subject" placeholder="Vaša poruka..." style="height:200px"></textarea><br>
					<input type="submit" value="Submit">
				</form>
				</div>
			</div>';
		?>