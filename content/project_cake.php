<!-- <title>{{Project Name}}</title> -->
<!-- Riferimento al file JavaScript esterno per la generazione del line chart -->
<!-- <script src="line_chart_script.js"></script> -->
<?php
	include "scripts/generate_header.php";


	generate_header("Torta - Penny Wise");
?>
<script type="module" src="assets/js/tag_sidebar.js"></script>
<script type="module" src="assets/js/share_project.js"></script>

	import project_info.php

	<!-- Canvas per il line chart -->
	<canvas id="cake-chart-canvas" class="cake-chart-container"></canvas>

	import transazioni_list.php

	<aside class="filtri-tag-container">
	<a href="project_home.php?id=<?php
echo $_GET['id'];
?>">Vai al <span lang"en">homepage<span> del progetto</a>
	import tag_sidebar.php

	import partecipanti_sidebar.php

	import footer.html
</body>

</html>
