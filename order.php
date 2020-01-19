<!DOCTYPE html>
<?php
session_start();
include("config.php");
?>
<html>
<head>
	<title> Pizza Order </title>
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
			<form method="POST" action="finalize.php">
			<?php
			//This page receives the the pizza names the customer selected, goes to the database to find the corresponding price for rach pizza
			$pizza = $_POST["pizza"];
			echo "<table>";
			echo "<tr> <td> <h2> Pizza </h2> <hr/> </td> <td> <h2> Price </h2 ><hr/> </td> <td> <h2> Amount </h2> <hr/> </td> </tr>";
			foreach($pizza as $value){
				$sql="SELECT * FROM pizzas WHERE Pizza_Name='$value'";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($result);
				echo "<tr> <td> <h4>".$row['Pizza_Name']."</h4> </td>";
				echo "<input type='hidden' value='".$row['Pizza_Name']."' name='pizza[]'>";
				echo "<td><input type='number' readonly value=".number_format($row['Price'],2)." name='price[]'> Euros </td>";
				//The customer selects how many pizzas he wants from each type and then is send to the review order page
				echo "<td> <input type='number' placeholder='1' value='1' min='1' max='99' name='numberOfPizzas[]'> </td> </tr>";
			}
			echo "<td colspan='3'> <input type='submit' value='Review Order'> </td> </tr>";
			echo "</table>";
			?>
			</form>
		</div>
	</div>
</body>
</html>