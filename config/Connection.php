<?php
/**
*      ___                        ___                          _
*     / __\__  _ __ _ __ ___     / _ \___ _ __   ___ _ __ __ _| |_ ___  _ __
*    / _\/ _ \| '__| '_ ` _ \   / /_\/ _ \ '_ \ / _ \ '__/ _` | __/ _ \| '__|
*   / / | (_) | |  | | | | | | / /_\\  __/ | | |  __/ | | (_| | || (_) | |
*   \/   \___/|_|  |_| |_| |_| \____/\___|_| |_|\___|_|  \__,_|\__\___/|_|
* @author Marcelo Ramos Soares <ramos3d.com>
* v.1.0 - 2020-04-10
*/

class Connection
{
    protected $host     = 'localhost';
    protected $user     = 'root';
    protected $password = '';
    protected $dbName   = '';
    public function connect(){
        try {
            $mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbName);
            return $mysqli;
        } catch (Exception $e) {
            return $e->getMessage;
        }
    }
}
