<!-- Filtri per tag -->
	<h2>Filtri per Tag</h2>
	<form id="tag_sidebar">
<?php
$sql = "SELECT tag.nome FROM tag
			WHERE id_progetto = '${project['id']}'";
$result = mysqli_query($conn, $sql);
if ($result) {
	$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach ($array as $row) {
		$nome = $row['nome'];
		echo "<label for='$nome'>$nome</label>";
		echo "<input type='radio' id='$nome' name='$nome' value='$nome'>";
	}
}
?>
	</form>
</aside>
