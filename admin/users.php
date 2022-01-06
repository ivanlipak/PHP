<?php 
	
	if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
		$query  = "UPDATE users SET firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', role='" . $_POST['role'] . "', country='" . $_POST['country'] . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		
		@mysqli_close($MySQL);
		
		$_SESSION['message'] = '<p>Uspješno ste promijenili korisnika!</p>';
		
	
		header("Location: index.php?menu=7&action=1");
	}

	if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM users";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Uspješno ste obrisali korisnika!</p>';

		header("Location: index.php?menu=7&action=1");
	}

	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['id'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<h2>Profil korisnika</h2><br>
		<p><b>Ime:</b> ' . $row['firstname'] . '</p>
		<p><b>Prezime:</b> ' . $row['lastname'] . '</p>
		<p><b>Korisničko ime:</b> ' . $row['username'] . '</p>
		<p><b>Grad:</b> ' . $row['grad'] . '</p>
		<p><b>Ulica i broj:</b> ' . $row['ulica'] . '</p>
		<p><b>Datum rođenja:</b> ' . $row['datumrodenja'] . '</p>';
		$_query  = "SELECT * FROM countries";
		$_query .= " WHERE country_code='" . $row['country'] . "'";
		$_result = @mysqli_query($MySQL, $_query);
		$_row = @mysqli_fetch_array($_result);
		print '
		<p><b>Država:</b> ' .$_row['country_name'] . '</p>
		
		<p><b>Datum:</b> ' . pickerDateToMysql($row['date']) . '</p>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Natrag</a></p>';
	}
	else if ((isset($_GET['edit']) && $_GET['edit'] != '')) {
		if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
			$query  = "SELECT * FROM users";
			$query .= " WHERE id=".$_GET['edit'];
			$result = @mysqli_query($MySQL, $query);
			$row = @mysqli_fetch_array($result);
			$checked_archive = false;

		print '
		<h2>Edit user profile</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
			
			<label for="fname">Ime *</label>
			<input type="text" id="fname" name="firstname" value="' . $row['firstname'] . '" placeholder="ime.." required>

			<label for="lname">Prezime *</label>
			<input type="text" id="lname" name="lastname" value="' . $row['lastname'] . '" placeholder="prezime.." required>
				
			<label for="email">E-mail *</label>
			<input type="email" id="email" name="email"  value="' . $row['email'] . '" placeholder="e-mail.." required>
			
			<label for="username">Korisničko ime *<small>(Username must have min 5 and max 10 char)</small></label>
			<input type="text" id="username" name="username" value="' . $row['username'] . '" pattern=".{5,10}" placeholder="korisnicko ime.." required>

			<label for="fgrad">Grad *</label>
			<input type="text" id="fgrad" name="grad" value="' . $row['grad'] . '" placeholder="grad.." required>

			<label for="fulica">Ulica i broj *</label>
			<input type="text" id="fulica" name="ulica" value="' . $row['ulica'] . '" placeholder="ulica i broj.." required><br>

			<label for="fdate">Datum Rođenja: *</label>
			<input style="width:50%" type="date" id="fdate" name="datumrodenja" value="">

			<br><br>
			<label for="country">Država</label>
			<select name="country" id="country">
				<option value="">Odaberite</option>';
				
				$_query  = "SELECT * FROM countries";
				$_result = @mysqli_query($MySQL, $_query);
				while($_row = @mysqli_fetch_array($_result)) {
					print '<option value="' . $_row['country_code'] . '"';
					if ($row['country'] == $_row['country_code']) { print ' selected'; }
					print '>' . $_row['country_name'] . '</option>';
				}
			print '
			</select>

			<label for="role">Status</label>
				</select name="role" id="role">

					<select name="role" id="role">
					<option value="" selected>Molimo vas odaberite</option>
					<option value="2">Editor</option>
					<option value="3">User</option>
					<option value="1">Admin</option>

				
				</select>
			
			<label for="archive">Arhiviraj:</label><br />
            <input type="radio" name="archive" style="width: 5%; text-align:center" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> DA <br>
			<input type="radio" name="archive" style="width: 5%; text-align:center" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NE
			
			<hr>
			
			<input type="submit" value="Submit">
		</form>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Natrag</a></p>';
	}}
	else {
		print '
		<h2>Lista korisnika</h2>
		<div id="users">
			<table>
				<thead>
					<tr>
						<th width="16"></th>
						<th width="16"></th>
						<th width="16"></th>
						<th>Ime</th>
						<th>Prezime</th>
						<th>E mail</th>
						<th>Država</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM users";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr>
					<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '"><img class="but" src="images/user.png" alt="user"></a></td>
					<td>';
						if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
							print '<a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img class="but" src="images/edit.png" alt="uredi"></a></td>';
						}
					print '
					<td>';
						if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
							print '<a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img class="but" src="images/delete.png" alt="obriši"></a>';
						}
					print '	
						<td><strong>' . $row['firstname'] . '</strong></td>
						<td><strong>' . $row['lastname'] . '</strong></td>
						<td>' . $row['email'] . '</td>
						<td>';
							$_query  = "SELECT * FROM countries";
							$_query .= " WHERE country_code='" . $row['country'] . "'";
							$_result = @mysqli_query($MySQL, $_query);
							$_row = @mysqli_fetch_array($_result, MYSQLI_ASSOC);
							print $_row['country_name'] . '
						</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<img src="images/inactive.png" alt="" title="" />'; }
                            else if ($row['archive'] == 'N') { print '<img src="images/active.png" alt="" title="" />'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
		</div>';
	}

	@mysqli_close($MySQL);
?>