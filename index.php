<?php
/**
*      ___                        ___                          _
*     / __\__  _ __ _ __ ___     / _ \___ _ __   ___ _ __ __ _| |_ ___  _ __
*    / _\/ _ \| '__| '_ ` _ \   / /_\/ _ \ '_ \ / _ \ '__/ _` | __/ _ \| '__|
*   / / | (_) | |  | | | | | | / /_\\  __/ | | |  __/ | | (_| | || (_) | |
*   \/   \___/|_|  |_| |_| |_| \____/\___|_| |_|\___|_|  \__,_|\__\___/|_|
*   @author Marcelo Ramos Soares <ramos3d.com>
*   v.1.0 - 2020-04-10
*/

require_once("config/Main.php");
$model = new Main;
$tables = $model->getTables();
if ($tables ==''){
    $msg = 'No table has been found. <br> Is there really a table in this database?';
}
if ($_POST) {
    if ($_POST['table_list'] =='') {
        $msg = "Plase, select a table first!";
    }
    $model->generate();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style media="screen">
.title{ color: #4a902d; }
.sub{ color: #babdb9; font-size: 13px;}
</style>
<body>
    <div class="container ">
        <div class="row">
            <div class="mt-2 col-md-12">
                <div class="text-center">
                    <div class="title">
                        <h1>Form Generator</h1>
                    </div>
                    <span class="text-center sub">Developed by <a href="https://ramos3d.com" target="_blank">ramos3d.com</a> </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header"style="background:#ffe7c0">
                        Table Manager
                    </div>
                    <div class="card-body">
                        <div class="row text-secondary">
                            <div class="col-md-6">
                                <h5 class="card-title text-info">Help!</h5>
                                <p class="card-text">Steps:</p>
                                <ul>
                                    <li>1. Set your database connetion in <span class="text-info">/config/Connection.php</span> </li>
                                    <li>2. Reload this page</li>
                                    <li>3. Select your table on the right side</li>
                                    <li>4. Enjoy :) </li>
                                </ul>
                                <hr>
                                <span class="text-warning">Attention:</span>
                                <p> This system will add as Input Label all respective comments existing in your table.</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Select your table</h5>
                                <?php if ($_GET['success']): ?>
                                    <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                                        <?php echo $_GET['success']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php if ($_GET['error']): ?>
                                    <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                                        <?php echo $_GET['error']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <form class="" action="" method="post">
                                    <select class="form-control" name="table_list">
                                        <option value="" class="sub">-- select table --</option>
                                        <?php if (isset($tables) && is_array($tables)): ?>
                                            <?php foreach ($tables as $table): ?>
                                                <option value="<?php echo $table ?>"> <?php echo $table ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php if (isset($msg)): ?>
                                        <div class="alert alert-info mt-3 alert-dismissible fade show" role="alert">
                                            <?php echo $msg; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>



                                    <div class="mt-3">
                                        <label for="columns">How Many columns?</label><br>
                                        <select class="form-control" name="column">
                                            <option value="12">1 column</option>
                                            <option value="6">2 columns</option>
                                            <option value="4">3 columns</option>
                                            <option value="3">4 columns</option>
                                        </select>
                                        <small>Example: <span class="text-success"> 1 = 'col-md-12'</span></small>
                                        <small> | <span class="text-info"> 2 = 'col-md-6'</span></small>
                                        <small> | <span class="text-warning"> 3 = 'col-md-4'</span></small>
                                        <small> | <span class="text-danger"> 4 = 'col-md-3'</span></small>
                                    </div>
                                    <hr>
                                    <p>Output Path <span class="text-info">/forms_generated</span> </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center mt-3">
                                                <button type="submit"  class="btn btn-success"> Generate Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
