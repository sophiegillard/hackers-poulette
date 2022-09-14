<?php
function test_input($data) {
    //Returns a string without whitespace
    $data = trim($data);
    //unquoted quoted string if necessary
    $data = stripslashes($data);
    //Convert special characters to HTML entities
    //$data = htmlspecialchars($data);
    //Do not display HTML structure
    $data = strip_tags($data);
    return $data;
}

/*
function isEmptyNULL($data, $error){
    if(empty($_POST[$data])){
        $error = "Please enter a valid $data";
    } else{
        $data = test_input($_POST[$data]);
        if(!preg_match("/^[a-zA-Z-']*$/")){
            $error = "only letters allowed";
        }
    }
    return $error;
}

function isEmpty($data, $name){
 $isEmpty = (empty($_POST[$data]))? "Please enter a valid $name" : true;
 echo $isEmpty;
};

function isMatch(){
    $isMatch = (!preg_match("/^[a-zA-Z-']*$/"))? "only letters allowed" : true;
    echo $isMatch;
};
*/
