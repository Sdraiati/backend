<!-- <title>Account Page</title> -->
<?php
	include "scripts/generate_header.php";

	generate_header("account_home");
?>

	<?php

	echo "<header>
		<h1>Benvenuto/a " . $_SESSION["username"] . "</h1>
	</header> ";

	?>

	<main>

	import account_info.php

	import project_list.php
	</main>

	import footer.html
</body>

</html>
