<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css>
        <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js></script>
        <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>
        <script defer src=https://use.fontawesome.com/releases/v5.0.6/js/all.js></script>
    </head>
    <style type="text/css">
        .btn-space {
        margin-left: 1%;
        }
        .form {
            padding: 2%;
            background-color: #e6e6e6;
            box-shadow: 1px 2px 2px;
        }
        </style>
<body background="#E6E6E6">
    <div class="container form">
        <div class="row">
            <h1>Form Generator</h1>
                <form action='#' method='POST'>
                    <div class="col-sm-8">
                        <div class="form-group col-xs-8"><label>id of user</label>
                              <br /><input type="text" id=name name=name class="form-control"><label>name of user</label>
                              <br /><input type="text" id=language name=language class="form-control"><label>Language of user</label>
                              <br /><input type="text" id=age name=age class="form-control"></div>
                    </div>
                    <div class="form-group col-xs-8">
                        <button type="button" class="btn btn-warning pull-right btn-space">Update</button>
                        <button type="button" class="btn btn-success pull-right btn-space">Save Register</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>