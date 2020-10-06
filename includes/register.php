<?php
    //session_start ();
    require_once 'database.php';
try {
    //$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //code...
    if(isset($_POST['register'])){
        $username=!empty($_POST['user']) ? trim($_POST['user']) : null;
        $password=!empty($_POST['password']) ? trim($_POST['password']) : null;

        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        //fetch the row
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0){
            echo "<script>alert ('Username Already Taken!');document.location='../index.php'</script>";
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $sql= "INSERT INTO users(username,password) VALUES (:username, :password)";


        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $passwordHash);

        $result = $stmt->execute();
        echo "<script>alert ('Thank you for registering!!!!');document.location='../index.php'</script>";
        //if($result){
            //echo "Thank you for registering!!!!";
        //}
    }
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
}

?>
<div class="col-md-6 login-right">
					<h2> Register Here </h2>
					<form action="includes/register.php" method="post">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="user" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
						<button type="submit" name="register" class="login-button"> Register </button>
					</form>					
				</div>
			</div>
		</div>		
	</div>