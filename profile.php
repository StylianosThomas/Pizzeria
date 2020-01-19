<!DOCTYPE html>
<?php
session_start();
include("config.php");
?>
<html>
<head>
	<title> Pizza Menu </title>
	<link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<header>
		<div class="wrapper">
			<div id="logo">
				<a href="home.php"><img src="images/logo.png"></a>
			</div>
			<div id="login">
				<table> <tr> <td>
				<?php
				//Cheching session if already logged in. If yes display customer name, if no, display the login procedure.				
				if(isset($_SESSION["First_Name"])) {
					echo "Hello " .$_SESSION['First_Name'];
					echo "<td> <form action='logout.php'> <input type='submit' value='Log Out'> </form> </td>";
				}
				else {
					?>
					<div id="login">
						<form method="post" action="profile.php">
							<td> <input type="text" placeholder=" Email" name="loginEmail"> </td>
							<td> <input type="password" placeholder=" Password"  name="loginPassword" > </td>
							<td> <input type="submit" value="Login" name="login"> </td>
							<?php 
							//Checking if customer exists in database, if yes create session and go to menu, if no show message
							if (isset($_POST["login"])) {
								$loginEmail = $_POST["loginEmail"];
								$loginPassword = $_POST["loginPassword"];
								$sql = "SELECT * FROM customers where Email='$loginEmail' AND Password='$loginPassword' ";
								$result = mysqli_query($conn,$sql);
								if (!$row= mysqli_fetch_assoc($result)){
									echo "Wrong email or password, please try again.";
								} else {
									$_SESSION['First_Name'] = $row['First_Name'];
									$_SESSION['Customer_ID'] = $row['Customer_ID'];
									header('Location:profile.php');
								}
							} ?>
						</form>
					</div> 
				<?php
				}
				?>
				</td> </tr> </table>
			</div>
		</div>
	</header>
	<div id="main" >
		<div class="wrapper">
			<form method="POST" action="order.php">
			<?php
			//This will go to the database, find all available pizzas, and show them to the customer in rows of 3.
			$sql = "SELECT * FROM pizzas";
			$result = mysqli_query($conn,$sql);
			$counter=0;
			echo "<table>";
			echo "<tr>";
			while($row = mysqli_fetch_array($result)){
				$counter++;
				echo "<td>";
				echo "<img src='pizzas/".$row['Pizza_Name'].".jpg'>";
				echo "<h4>".$row['Pizza_Name']."</h4> <hr/>";
				echo "<p>".$row['Ingredients']."</p>";
				echo "<p> Price: <input type='number' readonly value=".number_format($row['Price'],2)."> Euros</p>";
				//The customer checks the pizzas he wants to order and then he will be send to the order page.
				echo "<label class='container'> <input type='checkbox' value='".$row['Pizza_Name']."' name='pizza[]' >";
				echo "<span class='checkmark'> </span> <span id='choose'> Choose </span></label>";
				echo "</td>";
				if ($counter % 3 == 0){
					echo "</tr>";
					echo "<tr>";
				}
			}
			echo "<td colspan='3'> <input type='submit' value='Continue'> </td> </tr>";
			echo "</table>";
			?>
			</form>
		</div>
	</div>
</body>
</html>