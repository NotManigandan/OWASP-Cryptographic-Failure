<?php
session_start();
$error = "";
if (isset($_POST['loginbutton'])) {
    $Username = $_POST['uname'];
    $Pass = $_POST['pass'];
    extract($_POST);
    $conn = mysqli_connect('localhost', 'mani1', 'mani2002', 'crms');
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }
    $sql = mysqli_query($conn, "SELECT * FROM  `admin` where Username='$Username' and Pass='$Pass'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        $_SESSION["uname"] = $row['Username'];
        $_SESSION["Pass"] = $row['Pass'];
        header("Location: dashboard.html");
    } else {
        $error = "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMS</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
</head>

<body>
    <div class="loginbox">
        <img src="images/avatar.jpg" class="avatar">
        <h1> CRMS</h1>
        <form action="login.php" method="post">
            <h1>Admin Login</h1>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <label for="username"><b>Username</b></label>
            <input type="text" name="uname" placeholder="Enter Username" id="username">
            <label for="password"><b>Password</b></label>
            <input type="password" name="pass" placeholder="Enter Password" id="password">
            <p style="color: #ff0033; text-align: center"><?php echo $error; ?></p>
            <input type="submit" name="loginbutton" value="Login">
        </form>
    </div>
</body>

</html>
