<?php
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return preg_match('/^[a-zA-Z0-9]{4,}$/', $password);
}

function validateFullName($fullname) {
    return preg_match('/^[a-zA-Z ]+$/', $fullname);
}
?>
