<?php
include "../api/config/database.php";
?>

<!-- Filtri per tag -->
<aside class="filtri-tag-container">
	<a href="project_cake.html">Vai al Grafico a Torta</a>
	<h2>Filtri per Tag</h2>
	<form id="tag_sidebar">
<?php
$id = $_GET['id'];
$query = "SELECT tag.nome FROM tag
			WHERE tag.id_progetto = '$id'";
$result = mysqli_query($conn, $query);
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

	<a href="tag_page.html">Vai alla Pagina dei Tag</a>
</aside>

<script type="module" src="assets/js/tag_sidebar.js"></script>
