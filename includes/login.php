<?php
    require_once 'database.php';

    try{
        if(isset($_POST['login'])){
            $username=!empty($_POST['user']) ? trim($_POST['user']) : null;
            $password=!empty($_POST['password']) ? trim($_POST['password']): null;
            
            $sql = "SELECT username, password FROM users WHERE username=:username";
            $stmt=$conn->prepare($sql);

            $stmt->bindValue(':username', $username);
           

            $stmt->execute();

            //Fetch row
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
            if($user===false){
                header("Location: ../index.php?error:InvalidUsernameOrPassword");
            }else{
                $validPassword = password_verify($password, $user['password']);
                if($validPassword){
                    //$break='\r\n';
                    //header("Location: ../index.php?error:Success");
                    $_SESSION['user_id'] = $user['username'];
                    $_SESSION['logged_in'] = time();
                    header('Location:home.php');
                    exit;
                    //echo "<script>alert('Hello $username!!$break You have been successfully logged in!!');document.location='../index.php'</script>"; 
                    
                }else{
                    header("Location: ../index.php?error:InvalidUsernameOrPassword");
                }
            }
        }
    }catch(PDOException $e){
        echo "ERROR:" .$e->getMessage();
    }

?>

<div class="container">
		<div class="login-box">
			<div class="row">
				<div class="col-md-6 login-left">
					<h2> Login Here </h2>
					<form action="includes/login.php" method="post">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="user" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
						<button type="submit" name="login" class="login-button"> Login </button>
					</form>					
				</div>
