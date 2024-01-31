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
		import tag_list.php
	</main>

	import footer.html

</body>

</html>
