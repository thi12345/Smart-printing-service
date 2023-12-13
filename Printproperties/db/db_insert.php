<?php
    include "db/db_connect.php";
    
    

    // Đóng kết nối đến cơ sở dữ liệu
    
    function isName($str) {
        $arr="!@#$%^&*()_+*/[]{}:;,<.>/?\|0123456789";
        for ($i = 0; $i < strlen($str); $i++){
            for ($j = 0; $j < strlen($arr); $j++){
                if ($str[$i]===$arr[$j] || $str[$i]==="'" || $str[$i]==='"'){
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
    function isValidName($username){
        if ((strlen($username)<5 || strlen($username)>25) || !isName($username)){
            return "Invalid name!";
        }
        else return "Valid name!";
    }
    function isValidNumber($MSSV){
        $options = ["options" => ["min_range" => 1500000, "max_range" => 2400000]]; 
        if (!filter_var($MSSV, FILTER_VALIDATE_INT, $options)){
            return "Invalid MSSV!";
        }
        else return "Valid MSSV!";
    }
    function ValidName($username){
        if ((strlen($username)<5 || strlen($username)>25) || !isName($username)){
            return FALSE;
        }
        else return TRUE;
    }
    function ValidNumber($MSSV){
        $options = ["options" => ["min_range" => 1500001, "max_range" => 2320000]]; 
        if (!filter_var($MSSV, FILTER_VALIDATE_INT, $options)){
            return FALSE;
        }
        else {        
            return TRUE;
        }
    }
    
?>