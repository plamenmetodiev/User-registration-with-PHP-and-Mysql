<?php
require_once 'classes/user.php';

$objUser = new User();
$query = "SELECT * FROM users";
$stmt = $objUser->runQuery($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>SignUp Form - Plamen Metodiev</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>
    <div class="main-w3layouts wrapper">
        <div class="main-agileinfo">
            <div class="agileits-top">
                <a href="./register.php"><input type="submit" id="show-registration-form" name="" value="REGISTER"></a>
            </div>
        </div>
        <h1 id="title">User Data</h1>
        <div class="table-responsive offset-lg-2 col-lg-8">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php if($stmt->rowCount() > 0){
                                  while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <tr>
                                 <th scope="row"><?php print($rowUser['id']); ?></th>
                                    <td><?php print($rowUser['firstname']); ?></td>
                                    <td><?php print($rowUser['lastname']); ?></td>
                                    <td><?php print($rowUser['phonenumber']); ?></td>
                                    <td><?php print($rowUser['email']); ?></td>
                                    <td><a class="confirmation" name="delete" href="process.php?delete_id=<?php print($rowUser['id']); ?>"><i class="fa fa-trash-o" style="font-size:32px;color:red"></i></a></td>
                                 </tr>
                          <?php } } ?>
                            </tbody>
                        </table>

                      </div>

        <div class="colorlibcopy-agile">
            <p>© 2021 Plamen Metodiev Users Data. All rights reserved</a></p>
        </div>
        <ul class="colorlib-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>

</html>