<?php

// if it's going to need the database, then it's
// probabily smart to require it before we start

require_once(LIB_PATH.DS.'database.php');

class Photograph
{

    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;


    public    $errors = array();
    private   $temp_path;
    protected $upload_dir = "images";
    protected $upload_errors = array(
                                    UPLOAD_ERR_OK           => "NO Errors",
                                    UPLOAD_ERR_INI_SIZE     => "Large than upload max_file size",
                                    UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
                                    UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
                                    UPLOAD_ERR_NO_FILE 		=> "No file.",
                                    UPLOAD_ERR_NO_TMP_DIR   => "No temporary directory.",
                                    UPLOAD_ERR_CANT_WRITE   => "Can't write to disk.",
                                    UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
                                    );

    protected static $table_name = "photographs";
    protected static $db_fields  = array(
                                        'id',
                                        'filename',
                                        'type',
                                        'size',
                                        'caption'
                                        );

    // Pass in $_FILE['uploaded_file'] as an argument
    public function attach_file($file)
    {
        // perform error checking on the form parameters
        if(!$file || empty($file) || !is_array($file))
        {
            // nothing uploaded or wrong argument usage
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }else
        {
            // Set object attributes to the form parameters
            $this->temp_path = $file['tmp_name'];
            $this->filename  = basename($file['filename']);
            $this->type      = $file['type'];
            $this->size      = $file['size'];

            return true;
        }
    }
    public function save()
    {
        // A New Record won't have an id yer
        if(isset($this->id))
        {
            // Really just to update the caption
            $this->update();
        }
        else
        {
            // Make Sure there are no errors
            // Can't save if there are pre-exisiting errors
            if(!empty($this->errors))
            {
                return false;
            }
            // Make sure the caption is not too long for the database
            if(strlen($this->caption)>=255)
            {
                $this->errors[] = "The Caption can only be 255 characters long";
                return false;
            }

            // Can't save without filename and temp locations
            if(empty($this->filename) || empty($this->temp_path))
            {
                $this->errors[] = "The file location was not available";
                return false;
            }

            // Determine the Target_Path
            $target_path = SITE_ROOT.DS.'public'.DS.$this->upload_dir.DS.$this->filename;
            // Make sure a file doesn't already exist in the target locations
            if(file_exists($target_path))
            {
                $this->errors[] = "The file {$this->filename} already exists.";
                return false;
            }

            // Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path))
            {
                // Success
                // save a corresponding entry to the database
                if($this->create())
                {
                    // We are done with temp_path. the file isn't there anymore
                    unset($this->temp_path);
                    return true;
                }
            }else
            {
                // File was not moved
                $this->errors[] = "The file upload failed. possibly due to incorrect permission in the upload folder";
            }
        }
    }
    public function destroy()
    {
        // first remove the database entry
        if($this->delete())
        {
            // then remove the file
            // note that even though the database entry is gone, this object
            // is still around which lets us use($this->image_path())
            $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
            return unlink($target_path) ? true : false;
        }else
        {
            // database delete failed
            return false;
        }
    }
    public function image_path()
    {
        return $this->upload_dir.DS.$this->filename;
    }
    public function size_as_text()
    {
        if($this->size <1024)
        {
            return "{$this->size} bytes";
        }
        elseif($this->size<1048576)
        {
            $size_kb = round($this->size/1024);
            return "{$size_kb} KB";
        }
        else
        {
            $size_mb = round($this->size/1048576,1);
            return "{$size_mb} MB";
        }

    }
    public function comments()
    {
        return Comments::find_comments_on($this->id);
    }


    // Common Database Methods
    public static function find_all()
    {
        $sql = "SELECT * FROM " . self::$table_name;
        return self::find_by_sql($sql);
    }
    public static function find_by_id($id = 0)
    {
        $result_array = self::find_by_sql("SELECT * FROM ". self::$table_name. " WHERE id = {$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    public static function find_by_sql($sql="")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set))
        {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }
    private static function instantiate($record)
    {
        // Could check that $record exists and is an array
        $object = new self;
        // Simple, long-form approach
        // $object->id              = $record['id'];
        // $obejct->username        = $record['username'];
        // $object->password        = $record['password'];
        // $object->first_name      = $record['first_name];
        // $object->last_name      = $record['last_name];

        // More Dynamic Short-form approach:
        foreach($record as $attribute=>$value)
        {
            if($object->has_attribute($attribute))
                $object->$attribute = $value;
        }
    }
    private function has_attribute($attribute)
    {
        // We don't care about the value, we just want to know if the key exists
        // will return true or false
        return array_key_exists($attribute, $this->attributes());
    }
    private function attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        foreach(self::$db_fields as $field)
        {
            if(property_exists($this,$field))
            {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    protected function sanitized_attributes()
    {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // note: does not alter the actual value of each attributes
        foreach($this->attributes() as $key=>$value)
        {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

//    replaced with a custom save()
//    public function save()
//    {
//        // A New record won't have an id yet
//        return isset($this->id) ? $this->update(): $this->create();
//    }
    public function create()
    {
        global $database;
        // Don't forget your SQL syntax and good habits
        // - INSERT INTO table (key,key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ";
        $sql.= self::$table_name." (";
        $sql.= join(", ", array_keys($attributes));
        $sql.= ") ";
        $sql.= "VALUES ('";
        $sql.= join("', '", array_values($attributes));
        $sql.= "')";

        if($database->query($sql))
        {
            $this->id = $database->insert_id();
            return true;
        }
        else
        {
            return false;
        }

    }
    public function update()
    {
        global $database;
        // Don't forget your SQL Syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key=>$value)
        {
            $attribute_pairs[] = "{$key} = '{$value}'";
        }
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql.= join(", ", $attribute_pairs);
        $sql.= "WHERE id = " . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;

    }
    public function delete()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM " . self::$table_name;
        $sql.= " WHERE id = ";
        $sql.= " LIMIT 1";
        $database->query($sql);
        return($database->affected_rows() == 1)? true : false;

        // NB: After deleting, the instance of User still
        // exists, even though the database entry does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted";
        // but, for example, we can't call $user->update()
        // after calling $user->delete().
    }

}



?>