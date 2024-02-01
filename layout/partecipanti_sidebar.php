<!-- Partecipanti -->
<aside class="partecipanti-container">
	<h2>Partecipanti</h2>
	<ul id="partecipanti-list">
<?php
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$sql = "SELECT utente.username 
				FROM (utente INNER JOIN progetto_utente 
					ON utente.email = progetto_utente.email) 
				WHERE id_progetto = $id;";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
		foreach ($array as $row) {
			echo "<li>" . $row['username'] . "</li>";
		}
	}
?>
	</ul>
</aside>
