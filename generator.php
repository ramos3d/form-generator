<?php
class Generate{
    public function FormGenerator(&$table, &$path){
        error_reporting(0);
        include ("connection.php");
        if (!$path){$path="formCreated";}
        $query = "SELECT column_comment FROM information_schema.columns WHERE table_name =\"$table\"";
        # Catching Comments to add them as Form labels
        if ($result = $Mysqli->query($query)) {
            $i=0;
            $return = $Mysqli->query($query);
            while ($com = $return->fetch_assoc()){
                $Labels[$i]=$com['column_comment'];
                $i++;
            }
        }
        #Catching the field names using describe
        $queryField = "DESCRIBE $table";
        $result = $Mysqli->query($queryField);
        $i=0;
        while ($a =$result->fetch_assoc()) {
            #Excluding id field as standard
            if ($a[Field]!="id"){
                    $FieldNames[$i] = $a[Field];
                    $i++;
            }
        }
        $form = fopen("$path/form.php", "a");
        $writing = fwrite($form, "<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css>
        <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js></script>
        <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>
        <script defer src=https://use.fontawesome.com/releases/v5.0.6/js/all.js></script>
    </head>
    <style type=\"text/css\">
        .btn-space {
        margin-left: 1%;
        }
        .form {
            padding: 2%;
            margin-top:2%;
            background-color: #e6e6e6;
            box-shadow: 1px 2px 2px;
        }
        </style>
<body background=\"#E6E6E6\">
    <div class=\"container form\">
        <div class=\"row\">
            <h1>Form Generator</h1>
                <form action='#' method='POST'>
                    <div class=\"col-sm-8\">
                        <div class=\"form-group col-xs-8\">");
                          foreach ($FieldNames as $key => $value) {
                              $writing = fwrite($form, "<label>".$Labels[$key]."</label>");
                              $writing = fwrite($form, "
                              <br /><input type=\"text\" id=$value name=$value class=\"form-control\">");
                          }
                        $writing = fwrite($form,"</div>
                    </div>
                    <div class=\"form-group col-xs-8\">
                        <button type=\"button\" class=\"btn btn-warning pull-right btn-space\">Update</button>
                        <button type=\"button\" class=\"btn btn-success pull-right btn-space\">Save Register</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>");
    }
}
?>
