<!DOCTYPE html>
<?php
session_start();
include("config.php");
?>
<html>
<head>
	<title> Place Order </title>
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
            <form method="POST" action="orderPlacement.php">
            <?php
			//This form receives value from the ordering page, shows a summary of the customer choices and calculates his total
            $name = $_POST["pizza"];
            $price = $_POST["price"];
            $numberofpizzas = $_POST["numberOfPizzas"];
            $x = count($price);
            $totalCost = 0;
            echo "<table>";
			echo "<tr> <td> <h2> Pizza : Price x Number = Total <hr/> ";
            for ($i=0; $i<$x; $i++){
                echo $name[$i]." : ".$price[$i]." x ".$numberofpizzas[$i]." = ".number_format($price[$i] * $numberofpizzas[$i],2);
                echo "<br>";
                $totalCost += $price[$i] * $numberofpizzas[$i];
            }
            echo " <hr/> The total cost of your order is: ".$totalCost." Euros";
			echo "</h2> </td> </tr>";
			//Checks if the customer is logged in, if yes he can place the order, if not he has to log in to proceed
            if (isset($_SESSION["First_Name"])){
                echo "<input type='hidden' value='".$totalCost."' name='finalPrice' >";
                echo "<tr> <td> <input type='submit' value='Place Order'> </td> </tr>";
            } else {
                echo "<tr> <td> <h2> You have to be logged in to place the order  </h2> </td> </tr>";

            }
            echo "</table>";
            ?>
            </form>
		</div>
	</div>
</body>
</html>

