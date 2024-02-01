<?php
	include "scripts/generate_header.php";

	generate_header("Home");
?>

<header>
	<h1>Shared Project - 

<?php
include "api/config/database.php";

$project_id = $_GET['id'];
$sql = "SELECT * FROM progetto WHERE link_condivisione = \"$project_id\";";
try {
$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo "Errore: " . $e->getMessage();
}
$project = mysqli_fetch_assoc($result);

echo $project['nome'];
?>
</h1>
	</header>

<section id="joinProject" class='allert'>
	<h1>Partecipa al progetto</h1>
	<form id="joinProjectForm" action="api/progetto/entra_nel_progetto.php" method="post">
		<input type="hidden" name="id_progetto" value="<?php echo $_GET['id'] ?>">
		<div class="form-buttons">
			<button type="button" data-button-kind="joinProjectHide">Annulla</button>
			<button type="submit" id="submitJoinProject">Partecipa</button>
		</div>
</section>

</body>

</html>
