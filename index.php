<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>
    <style type="text/css">
        .btn-space {
        margin-left: 1%;
        }
        .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #CEE3F6;
        text-align: center;
        }
    </style>
    <body>
        <div class="container">
            <div class="row">
                <h1> <i class="fas fa-database "></i> Form Generator</h1>

                <div class="alert alert-info">
                  <strong>First Steps!</strong> <p>Welcome to Form-Generator project,</p>
                  <p>Please, do not forget to configure the connection.php file with your connection datas before to continue.</p>
                  <p>Once done, fill out the form bellow with your both Table name and fold path. Then click on Generate Form. It's pretty simple and easy, </p>
                  <p>I hope you enjoy!</p>
                </div>
                <form action="#" method="GET">
                    <div class="col-sm-12">
                        <div class="form-group col-xs-4">
                            <label>Table Name:</label>
                    		<input type="text" class="form-control"  name="table">
                        </div>
                        <div class="form-group col-xs-4">
                            <label>Path:</label>
                    		<input type="text" class="form-control"  name="path" placeholder="Default is 'formCreated' fold">
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
<div class="rows">
    <div class="footer">
        <p> Copyright © 2017 <a href="http://ramos3d.com" target="blank">Marcelo Soares</a>. All Rights Reserved </p>
    </div>
</div>
    </body>
</html>
