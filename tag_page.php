<?php
	include "api/config/database.php";
	include "scripts/generate_header.php";

	generate_header("Home");
?>

	<header>
		<h1><?php
$project_id = $_GET["id"];
$sql = "SELECT progetto.nome FROM progetto WHERE progetto.id = $project_id;";
$result = mysqli_query($conn, $sql);
$project = mysqli_fetch_assoc($result);
echo $project["nome"];

?> - Tag</h1>
	</header>

	<main>
<?php
include "../api/config/database.php";
?>
<section>
	<h2>Tabella dei Tag</h2>
	<button data-button-kind="newTag">Nuovo Tag</button>

	<table id="tag-table">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Descrizione</th>
			</tr>
		</thead>
		<tbody>
<?php
$id = $_GET['id'];
$query = "SELECT tag.id, tag.nome, tag.descrizione FROM tag
			WHERE tag.id_progetto = $id";
$result = mysqli_query($conn, $query);
if ($result) {
	$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach ($array as $row) {
		$tag_id = $row['id'];
		$nome = $row['nome'];
		$descrizione = $row['descrizione'];
		echo "<tr><td>$nome</td><td>$descrizione</td><button data-button-kind=\"editTag\" data-tag-id=\"$tag_id\">Modifica</button></tr>";
	}
}
?>
		</tbody>
	</table>
</section>

<section id="newTag" class="allert" action="tag/crea_tag.php" method="post">
	<h2>Nuovo Tag</h2>
	<form>
		<input type="hidden" name="id_progetto" value="<?php echo $id ?>">
		<label for="newTagName">Nome</label>
		<input type="text" id="newTagName" name="nome" placeholder="Nome del Tag" required>
		<label for="newTagDescription">Descrizione</label>
		<textarea id="newTagDescription" name="descrizione" placeholder="Descrizione del Tag" required></textarea>
		<button type="button" data-button-kind="newTagHide">Annulla</button>
		<button type="submit" id="submitNewTag">Salva</button>
	</form>
</section>

<section id="editTag" class="allert" action="tag/aggiorna_tag.php" method="post">
	<h2>Modifica Tag</h2>
	<form>
		<label for="editTagName">Nuovo Nome</label>
		<input type="hidden" name="id_progetto" value="<?php echo $id ?>">
		<input type="text" id="editTagName" name="tagName" placeholder="Nome del Tag" required>
		<label for="editTagDescription">Nuova Descrizione</label>
		<textarea id="editTagDescription" name="tagDescription" required></textarea>
		<button type="button" data-button-kind="editTagHide">Annulla</button>
		<button type="submit" id="submitEditTag">Salva</button>
	</form>
</section>

<script type="module" src="assets/js/tag_list.js"></script>

	</main>
<footer>
	<div class="footer-list">
		<h3>Prodotto</h3>
		<ul>
			<li><a href="account_home.php">I Miei Progetti</a></li>
			<li><a href="about_us.php">About Us</a></li>
		</ul>
	</div>
	<div class="footer-list">
		<h3>Risorse</h3>
		<ul>
			<li><a href="index.php">Homepage</a></li>
			<li><a href="release_notes.php">Release Notes</a></li>
			<li><a href="https://github.com/Sdraiati" target="_blank"> <img src="assets/img/github-mark-white.png"
						id="github-mark"> GitHub </a></li>
		</ul>
	</div>
</footer>


</body>

</html>
