<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js">
    </script><link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <?php include "include/header.php";?>
            <form action="#" method="GET">
                <div class="col-sm-12">
                    <div class="form-group col-xs-4">
                        <label>Table Name:</label>
                        <input type="text" class="form-control"  name="table">
                    </div>
                    <div class="form-group col-xs-4">
                        <label>Path:</label>
                        <input type="text" class="form-control"  name="path" placeholder="/formCreated">
                        (Place where your form will be generated)
                    </div>
                </div>
                <div class="form-group col-xs-8">
                    <button type="submit" class="btn btn-success pull-right btn-space" name="Generate">Generate Form</button>
                </div>
            </form>
        </div>
        <div class="rows">
            <?php
            if (isset($_GET['Generate'])) {
                $table = $_GET['table'];
                $path  = $_GET['path'];

                if (!$table){
                    echo"<div class='alert alert-danger' role='alert'>
                    <strong>Attention</strong><p>Please, inform a table you want use</p>
                    </div>";
                }else{
                    echo"<div class='alert alert-success' role='alert'>
                    <strong>Success</strong> <p>Your form has been created successfully </p>
                    </div>";
                    include_once ("generator.php");
                    $gen = new Generate;
                    $gen->FormGenerator($table, $path);
                }
            }
            ?>
        </div>
        <?php include "include/footer.php"; ?>
    </body>
    </html>
