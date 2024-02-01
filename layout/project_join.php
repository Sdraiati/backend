<?php
// dovrebbe essere l'hash del progetto
$shared_project_id = $_GET['project_id'];
?>

<footer class="message-footer">
	<button type="button" data-button-kind="joinProject">Partecipa</button>
</footer>

<section id="joinProject" class="allert">
	<h1>Partecipa al progetto</h1>
	<form id="joinProjectForm" action="api/entra_nel_progetto.php" method="post">
		<input type="hidden" name="idProgetto" value="<?php echo $shared_project_id ?>">
		<div class="form-buttons">
			<button type="button" data-button-kind="joinProjectHide">Annulla</button>
			<button type="submit" id="submitJoinProject">Partecipa</button>
		</div>
</section>
