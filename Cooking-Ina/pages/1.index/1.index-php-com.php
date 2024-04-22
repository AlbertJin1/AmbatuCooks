<?php

session_start();

// IF USER IS LOGGED IN = SHOWS LOGOUT IN NAV
if (isset($_SESSION['userId'])) {
    $isLogged1 = true;
} else {
    $isLogged1 = false;
}

// IF USER IS NOT LOGGED IN = SHOWS LOGIN IN NAV
if (!isset($_SESSION['userId'])) {
    $isLogged2 = true;
} else {
    $isLogged2 = false;
}