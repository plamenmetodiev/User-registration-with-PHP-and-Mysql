<?php
require_once 'classes/user.php';

$objUser = new User();

if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    try{
      if($id != null){
        if($objUser->delete($id)){
          $objUser->redirect('index.php?deleted');
        }
      }else{
        var_dump($id);
      }
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  }
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
                            <?php
                              $query = "SELECT * FROM users";
                              $stmt = $objUser->runQuery($query);
                              $stmt->execute();
                            ?>
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
                                    <td><a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>"><i class="fa fa-trash-o" style="font-size:32px;color:red"></i></a></td>
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
    

    <script type="text/javascript">
        let passwordMatch = true;
        $(function () {
            $('#password, #confirm-password').on('keyup', function () {

                let password = $('#password')
                let confirmPassword = $('#confirm-password')
                let passwordMessage = $('#password-message')

                if (password.val() === confirmPassword.val() || confirmPassword.val() === "") {
                    passwordMatch = true;
                    passwordMessage.html('').css('color', 'white')
                    confirmPassword.css('margin-bottom', '2em')
                } else if (confirmPassword.val() !== "") {
                    passwordMatch = false;
                    confirmPassword.css('margin-bottom', '15px')
                    passwordMessage.html('Passwords do not match.').css('color', 'red').css(
                        'margin-bottom', '15px');
                }
            });

            $('#register').click(function (e) {
                let valid = this.form.checkValidity();
                let firstname = $('#firstname').val();
                let lastname = $('#lastname').val();
                let email = $('#email').val();
                let phonenumber = $('#phonenumber').val();
                let password = $('#password').val();
                if (valid && passwordMatch) {
                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: 'process.php',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phonenumber: phonenumber,
                            password: password,
                        },
                        success: function (data) {
                            Swal.fire({
                                title: 'Successful',
                                text: data,
                                icon: 'success',
                                confirmButtonText: 'Cool'
                            })
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Error',
                                text: data,
                                icon: 'error',
                                confirmButtonText: 'Okay'
                            })
                        }
                    });

                } else {
                    if (!passwordMatch) {
                        e.preventDefault();
                        console.log('not matching');
                    }
                }
            })

            $('#retrieve-data').click(function (e) {
                e.preventDefault();
                $('#form-register').css('display', 'none')
                $('#retrieve-data').css('display', 'none')
                $('.table-responsive').css('display', 'block')
                $('#show-registration-form').css('display', 'inline-block')
                $('#title').html('Users Data')

                let table = $('<table class="table table-striped">')
                let thead = $('<thead>')
                let tr = $('<tr>');

                thead.append(tr);
                table.append(thead)

                tr.append('<th scope="col">#</th>')
                .append('<th scope="col">First Name</th>')
                .append('<th scope="col">Last Name</th>')
                .append('<th scope="col">Phone Number</th>')
                .append('<th scope="col">Email</th>')

                <?php
                    $query = "SELECT * FROM users";
                    $stmt = $objUser->runQuery($query);
                    $stmt->execute();
                ?>
                let tbody = $('<tbody>')
                table.append(tbody)
                
                    <?php if($stmt->rowCount() > 0){
                        while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                let bodyTr = $('<tr>');
                bodyTr.append(`<th scope="row"><?php print($rowUser['id']); ?></th>`)
                bodyTr.append(`<td><?php print($rowUser['firstname']); ?></td>`)
                bodyTr.append(`<td><?php print($rowUser['lastname']); ?></td>`)
                bodyTr.append(`<td><?php print($rowUser['phonenumber']); ?></td>`)
                bodyTr.append(`<td><?php print($rowUser['email']); ?></td>`)
                bodyTr.append(`<td><a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>"><i class="fa fa-trash-o" style="font-size:32px;color:red"></i></a></td>`);
                tbody.append(bodyTr)
                <?php } } ?>
            $('.table-responsive').append(table)

            })

            $('#show-registration-form').click(function (e) {
                e.preventDefault();
                $('#form-register').css('display', 'block')
                $('#retrieve-data').css('display', 'inline-block')
                $('#show-registration-form').css('display', 'none')
                $('.table-responsive').empty()
                $('#title').html('SignUp Form')
            })

        })
    </script>

</body>

</html>