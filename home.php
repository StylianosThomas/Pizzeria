<!DOCTYPE html>
<html>
<head>
	<title> Home - Pizza </title>
	<link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<header>
		<div class="wrapper">
			<div id="logo">
				<img src="images/logo.png">
			</div>
			<div id="login">
				<form method="post" action="home.php">
					<table>
					<tr>
						<td> <input type="text" placeholder=" Email" name="loginEmail"> </td>
						<td> <input type="password" placeholder=" Password"  name="loginPassword" > </td>
						<td> <input type="submit" value="Login" name="login"> </td>
						<?php
						//Create session, Checking if customer exists in database, if yes go to menu, if no show message 
						session_start();
						if (isset($_POST["login"])) {
							include("config.php");
							$loginEmail = $_POST["loginEmail"];
							$loginPassword = $_POST["loginPassword"];
							$sql = "SELECT * FROM customers where Email='$loginEmail' AND Password='$loginPassword' ";
							$result = mysqli_query($conn,$sql);
							if (!$row= mysqli_fetch_assoc($result)){
								echo "Wrong email or password, please try again.";
							} else {
								$_SESSION['First_Name'] = $row['First_Name'];
								$_SESSION['Customer_ID'] = $row['Customer_ID'];
								header('Location:profile.php') ;
							}
						}
						?>
					</tr>
					</table>
				</form>
			</div>
		</div>
	</header>
<main class="wrapper">
	<section>
		<img src="images/pizza.jpg"/>
	</section>
	<div id="signup">
		<!-- This form will get user info and create a new entry in the table customer in the pizzaria database-->
		<form action="signup.php" method="post">
			<table >
				<tr> <th colspan="2"> SIGN UP </th> </tr>
				<tr> 
					<td> <input type="text" placeholder=" First Name " name="customerFirstName" > </td>
					<td> <input type="text" placeholder=" Last Name " name="customerLastName" ></td>
				</tr>
				<tr> <td colspan="2"> <input type="email" placeholder=" Email " name="customerEmail"></td> </tr>
				<tr> <td colspan="2"> <input type="password" placeholder=" Password" name="customerPassword1" ></td> </tr>
				<tr> <td colspan="2"> <input type="password" placeholder=" Confirm password" name="customerPassword2" ></td> </tr>
				<tr> <td colspan="2"> <input type="text" placeholder=" Street Address" name="customerStreetAddress"></td> </tr>
				<tr> <td> <input type="text" placeholder=" House Number" name="customerHouseNumber"></td>
				<td> <input type="text" placeholder=" City" name="customerCity"></td> </tr>
				<tr> <td colspan="2"> <input type="submit" value="Sign Up" ></td> </tr>
			</table>
		</form>
	</div>
</main>
</body>
</html>