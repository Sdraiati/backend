<?php
	include "scripts/generate_header.php";

	generate_header("Home");
?>
<script type="module" src="assets/js/line-chart-main.js"></script>
<script type="module" src="assets/js/line-chart-interactions.js"></script>
<script type="module" src="assets/js/tag_sidebar.js"></script>

	import project_info.php

	<ul id="line-chart-buttons">
		<li><button id="transazioni-precedenti">Precedente</button></li>
		<li><button id="transazioni-periodo-1-mese">1 mese</button></li>
		<li><button id="transazioni-periodo-6-mesi">6 mesi</button></li>
		<li><button id="transazioni-periodo-1-anno">1 anno</button></li>
		<li><button id="transazioni-successive">Successivo</button></li>
	</ul>
	<!-- Canvas per il line chart -->
	<canvas id="line-chart" class="line-chart"></canvas>

	import transazioni_list.html

	import tag_sidebar.php

	import partecipanti_sidebar.php

	import footer.html
</body>

</html>
