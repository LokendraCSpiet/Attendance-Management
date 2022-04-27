
<?php

if(isset($_POST['login']))
{
	//start of try block

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password is required!");
			
		}
		//establishing connection with db and things
		include ('connect.php');
		
		//checking login info into database
		$row=0;
		$result=mysqli_query($con,"select * from admininfo where username='$_POST[username]' and password='$_POST[password]' and type='$_POST[type]'");

		$row=mysqli_num_rows($result);

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>FYP-Attendance Management System</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" href="styles.css" >
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
     #body{
        /* background: url(../img/background.jpg) no-repeat; */
        background: #fff;
        background-size: 100%;
    }
    .codehim-form{
        max-width: 400px;
        min-height: 400px;
        box-sizing: border-box;
        background: rgba(255, 255, 255, 0.6);
        box-shadow: 4px 2px 16px rgba(0, 0, 0, 0.4);
        border-radius: 8px;
        margin:  20px auto 0 auto;
        padding: 25px;
        color: #414141;
            
    }
    .cm-input{
        display: block;
        box-sizing: border-box;
        padding: 10px;
        width: 100%; 
        margin: 14px auto;
        border-radius: 20px;
        border: 1px solid #ccc;
        
        
    }
    .cm-input:focus{
        outline: 0;
        border-color: #f9cb81;
        
    }
    .cm-input:invalid{
        border-color: #e41b17;
        
    }
	
	.btn-home{
        display: block;
        width: 10%;
        padding: 10px;
        border: 0;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
        
    }

    .btn-login,.btn-login1{
        display: block;
        width: 100%;
        padding: 10px;
        border: 0;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
        
    }
    .btn-login,.btn-login1:focus{
        outline: 0;
    }
    
    .btn-login,.btn-login1:hover{
        opacity: 0.8;
        transition: .3s;
    }
    
    /* Gradient Background */
    .gr-bg,.gr-bg1{
        background: rgb(252,205,128);
        background: linear-gradient(90deg, rgba(252,205,128,1) 0%, rgba(209,122,142,1) 55%, rgba(220,159,174,1) 100%);   
    }
	</style>

</head>

<body>
	<center>

<header>

  <h1>Attendance Management System</h1>

</header>



<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
?>

<!-- Old Version -->
<!-- 
<form action="" method="post">
	
	<table>
		<tr>
			<td>Username </td>
			<td><input type="text" name="username"></input></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></input></td>
		</tr>
		<tr>
			<td>Role</td>
			<td>
			<select name="type">
				<option name="teacher" value="teacher">Teacher</option>
				<option name="student" value="student">Student</option>
				<option name="admin" value="admin">Admin</option>
			</select>
			</td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><button><input type="submit" name="login" value="Login"></input></button></td>
			<td><button><input type="reset" name="reset" value="Reset"></button></td>
		</tr>
	</table>
</form>
-->

<div class="content">
	<div class="row">
		

		<form method="post" class="codehim-form form-horizontal col-md-6 col-md-offset-3" id="body">
			
	  <div class="form-title">
        <div class="user-icon gr-bg">
         <i class="fa fa-user"></i>
        </div>
       <h2>LOGIN</h2>
      </div>
	  

		    <div class="form-group">
			    <label for="input1" class="fa fa-envelope col-sm-3 control-label"> Username</label>
			    <div class="col-sm-7">
			      <input type="text" name="username"  class="cm-input form-control" id="input1" placeholder="your usrename" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-7">
			      <input type="password" name="password"  class="cm-input form-control" id="input1" placeholder="your password" />
			    </div>
			</div>


			<div class="form-group" class="radio">
			<label for="input1" class="col-sm-3 control-label">Role</label>
			<div class="col-sm-7">
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
			  </label>
			  	  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
			  </label>
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
			  </label>
			</div>
			</div>


			<input type="submit" id="p1" class="btn-login  gr-bg " value="Login" name="login" />
			
   
		</form>


	</div>
</div>
<p><a class="btn-home  gr-bg" href="index.php">Home</a></p>



<br><br>
<p><strong>Have forgot your password? <a href="reset.php">Reset here.</a></strong></p>
<p><strong>If you don't have any account, <a href="signup.php">Signup</a> here</strong></p>

</center>
</body>
</html>