<?php
    function CheckPassword($salt, $userPassword, $checkPassword){
        $checkHash = sha1($salt . $checkPassword); // get hash 
        return $checkHash == $userPassword; //check if passwords are equal

    }
?>