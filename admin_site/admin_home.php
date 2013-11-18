<?php
	$title="Admin Home";
	require"header.php";

	//kick user to login page if not logged in.
	if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}

?>
<div id="content">
	<div id="heading" >
		<h1>
			<?php 
				$user = ucfirst($_SESSION['activeuser']);
				echo "Welcome, $user "; 
			?>
		</h1>
		<a href="logout.php">
			<button id="logout">
				Logout
			</button>
		</a>
	</div>

	<h2>
		Please click below to begin.
	</h2>
	<div id="menu_buttons">
		<a href="new_walk.php"><button> New Walk </button></a>
		<a href="new_workshop.php"><button> New Workshop </button></a>
		<a href="calendar.php"><button> Calendar </button></a>
		<a href="members.php"><button> Members </button></a>
	</div>

	<div id="footer">
		<p>
			Designed and developed by WebKrunch 2013. 
			<br />
			Contact us at
			<a href="mailto:webkrunch@gmx.com">
				webkrunch@gmx.com
			</a>
		</p>
	</div>
</div>
</body>
</html>