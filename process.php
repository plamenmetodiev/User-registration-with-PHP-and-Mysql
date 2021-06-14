<?php 
require_once 'classes/user.php';

$objUser = new User();

if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    try {
      if($id != null){
        if($objUser->delete($id)){
          $objUser->redirect('user-data.php');
        }
      } else{
        var_dump($id);
      }
    } catch(PDOException $e){
      echo $e->getMessage();
    }
}

if(isset($_POST)){
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $phone_number = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    if($objUser->insert($first_name, $last_name, $email, $phone_number, $password)){
        echo "You have successfully registered. Enjoy!";
    } else{
        echo 'Error came up during registration. Please try again later!';
    }
}

?>