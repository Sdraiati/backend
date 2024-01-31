<!-- <title>{{Project Name}}</title> -->
<!-- Riferimento al file JavaScript esterno per la generazione del line chart -->
<!-- <script src="line_chart_script.js"></script> -->
<?php
	include "scripts/generate_header.php";


	generate_header("Home");
?>
<script type="module" src="assets/js/tag_sidebar.js"></script>

	import project_info.php

	<!-- Canvas per il line chart -->
	<canvas id="cake-chart-canvas" class="cake-chart-container"></canvas>

	import transazioni_list.html

	import tag_sidebar.php

	import partecipanti_sidebar.php

	import footer.html
</body>

</html>
