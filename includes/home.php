
<?php
    session_start();

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
        header('Location: ../index.php');
        exit;
    }else{
        $break='\r\n';
        echo "<script>alert('Hello!!$break You have been successfully logged in!!')</script>"; 
        //echo "WELCOME"." ".strtoupper($_SESSION['user_id']);
    }
    require '../header.php';
?>
<div class="container">
    <h1 class="mt-5 text-center">WELCOME <?php echo strtoupper($_SESSION['user_id']);?></h1>
</div>