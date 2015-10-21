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







?>