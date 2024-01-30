<?php
    include '../../api/config/database.php'
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data from the request body
    $post_data = file_get_contents("php://input");

    $decoded_data = json_decode($post_data, true);
	$idProgetto = $decoded_data["idProgetto"];
	$newNomeProgetto = $decoded_data["newNomeProgetto"];
	$newDescrizioneProgetto = $decoded_data["newDescrizioneProgetto"];

	$sql = "UPDATE progetto 
			SET
				nome = \"$newNomeProgetto\",
				descrizione = \"$newDescrizioneProgetto\"
			WHERE progetto.id = $idProgetto";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("Location: backend/project_home.php?id=$idProgetto");
}
}
?>
