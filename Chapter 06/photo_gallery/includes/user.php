<?php

// it's going to need the database
// so probabily it would be smart enough to require it before we start
require_once("database.php");

class User
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    private static $users_table_name = "users";
    private static $id_column_name = "id";


    private function has_attribute($attribute) {
        // get_object_vars returns an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value
        $object_vars = get_object_vars($this);
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }
    private static function instantiate($record) {
        // Could check that $record exists and is an array
        $object = new self;
        // Simple, long-form approach:
        // $object->id 				= $record['id'];
        // $object->username 	= $record['username'];
        // $object->password 	= $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name 	= $record['last_name'];

        // More dynamic, short-form approach:
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    public static function find_all()
    {
        $sql  = "SELECT * FROM ";
        $sql .= self::$users_table_name;

        return self::find_by_sql($sql);
    }
    public static function find_by_id($id=0)
    {
        global $database;

        $sql  = "SELECT * FROM ";
        $sql .= self::$users_table_name;
        $sql .= " ";
        $sql .= "WHERE ";
        $sql .= self::$id_column_name;
        $sql .= "=";
        $sql .= $id;
        $sql .= " ";
        $sql .= "LIMIT ";
        $sql .= 1;

        $result_set = self::find_by_sql($sql);
        return !empty($result_set) ? array_shift($result_set):false;

    }
    public static function find_by_sql($sql = "")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array=array();
        while($row = $database->fetch_array($result_set))
        {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }
    public function full_name()
    {
        if(isset($this->first_name) && isset($this->last_name))
        {
            return $this->first_name." ".$this->last_name."<br/>";
        }else
            return "";
    }
    public static function authenticate($username="", $password="")
    {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $sql = "SELECT * FROM ";
        $sql.= self::$users_table_name;
        $sql.= " ";
        $sql.= "WHERE username = '{$username}' ";
        $sql.= "AND password = '{$password}' ";
        $sql.= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array)?array_shift($result_array) : false;
    }

}

?>