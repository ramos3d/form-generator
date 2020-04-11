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

require_once "Connection.php";
class Main extends Connection
{
    public $db;
    public function __construct(){
        $this->db = new Connection;
        return $this->db->connect();
    }

    public function getTables(){
        $sql = sprintf("SHOW tables");
        try {
            $query = $this->db->connect()->query($sql);
            while ($name = $query->fetch_array()) {
                $tables [] = $name[0];
            }
            return $tables;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
    * Generate the form html
    * @return array
    */
    public function generate(){
        if ($_POST['table_list'] !='') {
            $table = $_POST['table_list'];
            $column = $_POST['column'];
            $path = $_POST['path'];
            $sql = sprintf("SELECT column_name, column_type, column_comment from information_schema.columns WHERE table_name ='$table' ");
            try {
                $query = $this->db->connect()->query($sql);
                while ($name = $query->fetch_assoc()) {
                    if ($name['column_type'] == '') {
                        $name['column_type'] = 'none';
                    }
                    $fields []  = $name['column_name'];
                    $fieldTypes[]= $name['column_type'];
                    $fieldLabels[]= $name['column_comment'];
                }
                $fields = array_unique($fields);
                $fieldLabels = array_unique($fieldLabels);

                foreach ($fields as $key=>$field) {
                    if ($fieldLabels[$key] == '') {
                        $fieldLabels[$key] = ' No Label';
                    }
                    $labels [$key] = "$key. ". $fieldLabels[$key];
                    // Setting types
                    if ($fieldTypes[$key] == '' or !isset($fieldTypes[$key])  or $fieldTypes[$key] == NULL)  {
                        $fieldTypes[$key] = 'varchar';
                    }
                    $types [$key] = $fieldTypes[$key];
                }
                // Prepare the columns
                $tab = "  ";
                $form = '';
                foreach ($fields as $key=>$fieldName) {
                    if(strpos($types[$key], 'varchar') !== false){
                        $type = 'text';
                    }
                    if(strpos($types[$key], 'date') !== false){
                        $type = 'date';
                    }
                    if(strpos($types[$key], 'int') !== false){
                        $type = 'number';
                    }
                    $form .= "
                    <div class=\"col-md-$column mb-2\">
                    $tab <label for=\"$fieldName\">$labels[$key]</label>
                    $tab <input type=\"$type\" name=\"$fieldName\" id=\"id-$fieldName\" class=\"form-control\">
                    </div>
                    ";
                }

                $time = date('Y-m-d H:m:i');
                // setting path
                if ($path =='') {
                    $path = "forms_generated";
                }
                $url ="$path/form-$table-$time.html";
                @$file = fopen("$url", "w");
                if ($file === false) {
                    $msg = "Please, verify if the folder has right permission to write";
                    return $_GET['error'] = $msg;
                }
                $header = $this->getHeader();
                $footer = $this->getfooter();
                $completeForm = $header . $form . $footer ;
                fwrite($file, $completeForm);
                $msg = "Form Generated Successfully. Go to: <a href='".$url."' target='_blank'>$url</a>";
                return $_GET['success'] = $msg;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
    * Add the html head
    * @var string
    */
    protected function getHeader(){
        return $header = "
        <!DOCTYPE html>
        <html lang=\"en\" dir=\"ltr\">
        <head>
        <meta charset=\"utf-8\">
        <title>Form Generated</title>
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">
        </head>
        <body>
        <div class=\"container\">
        <div class=\"row\">
        ";
    }

    /**
    * Add the html footer
    * @var string
    */
    protected function getFooter(){
        return $footer = "
        </div>
        </div>
        </body>
        <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>
        <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>
        ";
    }
}
