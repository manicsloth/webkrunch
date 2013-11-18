<? echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'";
echo "'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>";
  echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<meta name='author' content='Alan Crowle' />";
    echo "<meta name='keywords' content='fit, walking, nordic' />";
    echo "<meta name='description' content='Information on required fitness levels' />";
    echo "<meta name='robots' content='all' />";
    echo "<link rel='stylesheet' type='text/css' href='dropdownexample.css'";
  echo "</head>"; 


	echo "<body>"; 

function db_connect() {
							$config['db'] = array(
								'host'		=> 'localhost',
								'username'	=> 'administrator',
								'password'	=> 'parad1Gm',
								'dbname'	=> 'nordic'
								);
							$nordic_db= new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'],$config['db']['password']);
									return $nordic_db;
									}
						function walk_info() {			
							$nordic_db=db_connect();
							$query = $nordic_db->prepare("select `location` , `meet` , `directions` , `details` , `dogs` , `wtime` , `distance` , `imageurl` , `url` from `walks`");
							$query->execute();
							while($data= $query ->fetch(PDO::FETCH_ASSOC)) {
								echo "<li>";
								echo "<a href='any.html'>$data[location]</a>";
								echo "</li>";
							    }
							}


		echo "<h1>If you can walk, you can Nordic walk!</h1>";
		echo "<p>Nordic Walking really is for everyone. The poles mean that effort is shared between the upper and lower body and it actually feels easier than normal walking, particularly uphill.  It's really good exercise for problem areas such as the arms, stomach and bottom. But forget 'No pain no gain', this is 'No pain all gain'!  Nordic Walking puts less strain on joints than other activities and can be very effective for people with mobility issues or those recovering from illness or injury.</p>";
		echo "<p>It's also not all about speed, walking a little slower is a great calorie burner whilst walking faster increases your fitness. Walk Kernow provides Nordic Walks for everyone!</p>";
		echo "<img class='leftFloat' src='doineedtobefit.jpg'>";

		echo "<div id='topbanner'>";
			echo "<a href='mailto:walkkernow@gmail.com'>walkkernow@gmail.com</a>";
			echo "<p>07540478919</p>";
			echo "<img href='logo.png'>";
		echo "</div>";
				echo "<ul id='nav'>";
				   echo "<li>";
				   	echo "<a href='index.html'>Home</a>";
				   echo "</li>";
				   echo "<li>";
				   	echo "<a href='#'>About</a>";
				      echo "<ul>";
				         echo "<li>";
				         	echo "<a href='whatisnordicwalking.html'>What is Nordic walking?</a>";
				         echo "</li>";
				         echo "<li>";
				         	echo "<a href='doineedtobefit.html'>Do I need to be fit?</a>";
				         echo "</li>";
				         echo "<li>";
				         	echo "<a href='awholeworldofbenefits.html'>A whole world of benefits</a>";
				         echo "</li>";
				         echo "<li>";
				         	echo "<a href='hodoijoinyou.html'>How do I join you?</a>";
				         echo "</li>";
				         echo "<li>";
				         	echo "<a href='kelly.html'>Kelly Bennett INWA Instructor</a>";
				         echo "</li>";
				         echo "<li>";
				         	echo "<a href='suzanne.html'>Suzanne Allin BNW Walk Leader</a>";
				         echo "</li>";
				         echo "<li>";
				         	echo "<a href='testimonials.html'>Testimonials</a>";
				         echo "</li>";
				      echo "</ul>";
				   echo "</li>";
				   echo "<li>";
				   	echo "<a href='#'>What we offer</a>";
				   	echo "<ul>";
				   		echo "<li>";
				   			echo "<a href='beginnersworkshops.html'>Beginners Workshops</a>";
				   		echo "</li>";
				   		echo "<li>";
				   			echo "<a href='nordicwalks.html'>Nordic Walks</a>";
				   		echo "</li>";
				   		echo "<li>";
				   			echo "<a href='parties.html'>Hen/Stag/Birthday Parties</a>";
				   		echo "</li>";
				   	echo "</ul>";
				   echo "</li>";
				   echo "<li>";
				   	echo "<a href='#'>Nordic Walks</a>";
				   	 echo "<ul>";
				   	 	walk_info();
					echo "</ul>";
				   echo "</li>";
				   echo "<li>";
				   	echo "<a href='#'>Booking</a>";
				   	echo "<ul>";
				   		echo "<li>";
				   			echo "<a href='beginnersworkshops.html'>Beginners Workshop</a>";
				   		echo "</li>";
				   		echo "<li>";
				   			echo "<a href='bookwalks.html'>Book Nordic Walks</a>";
				   		echo "</li>";
				   		echo "<li>";
				   			echo "<a href='pricelist.html'>Pricing</a>";
				   		echo "</li>";
				   	echo "</ul>";
				   echo "</li>";
				   echo "<li>";
				   	echo "<a href='#'>Products</a>";
				   	echo "<ul>";
				   		echo "<li>";
				   			echo "<a href='nordicwalkingpoles.html'>Nordic Walking Poles</a>";
				   		echo "</li>";
				   		echo "<li>";
				   			echo "<a href='clothing.html'>Clothing and Accesories</a>";
				   		echo "</li>";
				echo "</ul>";
				
echo "</body>";
echo "</html>";
?>