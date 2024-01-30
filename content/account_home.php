<!-- <title>Account Page</title> -->
<?php
	include "../layout/head.html";
?>

<body>
	import nav.html
	<?php

	session_start();
	echo "<header>
		<h1>Benvenuto/a " . $_SESSION["username"] . "</h1>
	</header> ";

	?>

	<main>

		import account_info.html

		import project_list.html

	</main>

	import footer.html
</body>

</html>
