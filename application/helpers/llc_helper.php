<?php

function hashPw($pw) {
    return password_hash('llctempo'.$pw, PASSWORD_DEFAULT);
}

function verify($pw, $dbpw) {
    return password_verify('llctempo'.$pw, $dbpw);
}

function simplehash($pw) {
    return md5($pw.'llctempo');
}

function AN() {
    return $_SESSION['account_name'];
}

function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function now() {
    return date('Y-m-d H:i:s');
}

function refreshFunc($path, $msg = '') {
    if($msg != '') {
        $_SESSION['errmsg'] = $msg;
    }
    redirect(base_url().$path, 'refresh'); 
}

function passwordGen($length = 6, $isNumeric = false) {
    $pwd = "";

    for ($i=0; $i<$length; $i++) {
        $c = mt_rand(1,6);
        if($isNumeric == true){
            $c = 1;
        }

        switch ($c) {
            case ($c <= 2):
            //Add a number
            $pwd .= mt_rand(0,9);
            break;
            case ($c <= 4):
            //Add a uppercase letter
            $pwd .= chr(mt_rand(65,90));
            break;
            case ($c <= 6):
            //Add a uppercase letter
            $pwd .= chr(mt_rand(97,122));
            break;
        }
    }
    return $pwd;
}

function getRank($rank) {
    if($rank == 0) {
        return "Bronze";
    } else if($rank == 1) {
        return "Silver";
    } else if($rank == 2) {
        return "Gold";
    } else if($rank == 3) {
        return "Platinum";
    } else if($rank == 4) {
        return "Exclusive Benefits";
    } else if($rank == 5) {
        return "Private Club";
    }
}
