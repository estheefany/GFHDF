<?php

$errStyleDisplay = "font-size:18px;background-color:#fff4ce;border:1px solid red;";


function error_handler($code, $message, $file, $line) {
    global $errStyleDisplay;
    print "<pre style='$errStyleDisplay;border:none;'>";
    print("Code:".$code."\n");
    print("Message:".$message."\n");
    #print("File:".$file."\n");
    #print("Line:".$line."\n");
    print "</pre>";
}

set_error_handler('error_handler');


function exception_handler($e) {    
    $errors = array(
        E_USER_ERROR        => "User Error",
        E_USER_WARNING        => "User Warning",
        E_USER_NOTICE        => "User Notice",
    );
    
    global $errStyleDisplay;
    print "<pre style='$errStyleDisplay'>";
    print_r($errors[$e->getCode()].': '.$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine()."\n");
    print_r($e->getTraceAsString());
    print "</pre>";
}



set_exception_handler('exception_handler');