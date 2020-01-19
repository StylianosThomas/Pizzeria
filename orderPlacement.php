<!DOCTYPE html>
<?php
session_start();
include("config.php");
?>
<html>
<head>
	<title> Success </title>
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
    <?php
	//Receiving the total cost from the finalize order page, and creates a new entry to the order table in the database.
    $totalPrice = $_POST["finalPrice"];
    $orderDate = time();
    $customer = $_SESSION['Customer_ID'];

    $sql = "INSERT INTO orders(`Total_Price`, `Order_Date`, `Customer`) VALUES ('$totalPrice','$orderDate','$customer')";

    if ( $conn->query($sql) === TRUE) {
        echo "<br><h1> <p style='text-align:center;'> Your Order has been placed and is now being prepared </p>";
        echo "<br><p style='text-align:center;'> Thank you for choosing us! </p></h1>";
    } else {
        echo "No record was created";
        header('Location:home.php');
    }
    ?>
</body>
</html>