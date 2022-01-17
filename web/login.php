<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        require('query/conn.php');
        session_start();

        if(isset($_POST['username'])) {
            // remove backslashes
            $username = stripslashes($_REQUEST['username']);
            // escapes special characters in a string
            $username = mysqli_real_escape_string($conn, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            // Checking is user existing in the database or not 
            // $query = "SELECT * FROM users WHERE username='$username' AND password='".md5($password)."'";
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $query) or dir(mysql_error());
            $rows = mysqli_num_rows($result);

            if($rows == 1) {
                $_SESSION['username'] = $username;
               // Redirect user to index.php
                header("Location: index.php");
            }else {
                echo "<div class='form'>
                    <h3>Username/Password is incorrect.</h3>
                    <br>Click here to <a href='login.php'>Login</a>
                </div>";
            }
            }else {
        ?>  
        <div class="login-box">
            <div class="form">
                <img src="img/banner.png" alt="" width="300" height="44"><br><br>
                <form action="" method="post" name="login">
                <div class="textbox">
                <input type="text" name="username" placeholder="Username" required><br>
                </div><br>
                <div class="textbox">
                <input type="password" name="password" placeholder="Password" required><br>
                </div><br>
                <input type="submit" name="submit" class="btn" value="Login" >
            </form>
            </div>
                </div>
        </div>
            <?php } ?>
</body>
<style>
    body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background-color: black;
}
.login-box{
  width: 280px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  color: #FF8C00;
  ;
}
.login-box h1{
  float: left;
  font-size: 40px;
  border-bottom: 6px solid #F0FFFF;
  margin-bottom: 50px;
  padding: 13px 0;
}
.textbox{
  width: 100%;
  overflow: hidden;
  font-size: 20px;
  padding: 8px 0;
  margin: 8px 0;
  border-bottom: 1px solid #F0FFFF;
}
.textbox i{
  width: 26px;
  float: left;
  text-align: center;
}
.textbox input{
  border: none;
  outline: none;
  background: none;
  color:#FF8C00;
  font-size: 18px;
  width: 80%;
  float: left;
  margin: 0 10px;
}
.btn{
  width: 100%;
  background: none;
  border: 2px solid #F0FFFF;
  color: #FF8C00;
  padding: 5px;
  font-size: 18px;
  cursor: pointer;
  margin: 12px 0;
}
</style>
</html>