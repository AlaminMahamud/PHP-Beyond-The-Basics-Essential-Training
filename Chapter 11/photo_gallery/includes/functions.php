<?php
/*
// All functions are in same place
// TOC
    # strip_zeroes_from_date($marked_string="") || $cleaned_string
    # redirect_to($location=NULL)               ||
    # output_message($message="")               ||<p class=\"message\">{$message}</p>
*/
    /*
    // strip_zeroes_from_date
        * create a date in *15-*09-2015
        * replace *0 with ""
        * clean up the string
    */
    function strip_zeores_from_date($marked_string="")
    {
        $cleaned_string = str_replace("*0","",$marked_string);
        $cleaned_string = str_replace("*","",$cleaned_string);
        return $cleaned_string;
    }
    /*
     * redirect_to
     */
    function redirect_to($location=NULL)
    {
        if(!empty($location))
        {
            header("Location: {$location}");
            exit;
        }
    }
    /*
     * output_message
     */
    function output_message($message="")
    {
        if(!empty($message))
            return "<p class=\"message\">{$message} </p>";
        else
            return "";
    }
    function __autoload($class_name)
    {
        $class_name = strtolower($class_name);
        $path       = LIB_PATH.DS."{$class_name}.php";
        if(file_exists($path))
            require_once($path);
        else
            die("The file {$class_name}.php could not be found.");
    }
    function include_layout_template($template="")
    {
        include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
    }
    function log_action($action, $message="")
    {
        // making sure file exists or else creating a new file
        $file = "../logs/log.txt";
        if($handle = fopen($file, 'w'))
        {
            if(!is_writeable($file))
            {
                echo "Could not write to file<br/>";
                die();
            }
            fwrite($handle, strftime("%Y-%m-%d %H:%M",time()). " || "."{$action} : {$message}");
        }
    }


function datetime_to_text($datetime="")
{
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d %Y at %I:%M:%p", $unixdatetime);
}






?>