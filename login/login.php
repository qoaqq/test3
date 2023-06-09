<?php 
    session_start();
    require_once ("../connection.php");
    // if(isset($_SESSION['user'])){
    //     header('location: ../quantri.php');
    //     die;
    // }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM  user WHERE username='$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            if(password_verify($password,$user['password'])){
                $_SESSION['user'] = $user ;
                $msg = "dang nhap thanh cong";
                header('location: ../quantri.php ');
                die;
            }else{
                $errors['password'] = "mat khau khong dung";
            }
            
        }else{
            $errors['username'] = "tai khoan khong dung";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">username</label>
        <input type="text" name='username'>
        <span style='color:red'><?php echo $errors['password'] ?? '' ?> </span>
        <br>
        <label for="">password</label>
        <input type="password" name='password'>
        <br>
        <br>
        <button type="submit" name="submit">login</button>
    </form>
</body>
</html>