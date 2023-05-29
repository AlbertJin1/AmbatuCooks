<?php

session_start();

// IF USER IS NOT LOGGED IN IT WILL REDIRECT BACK TO LOGIN FORM
if (!isset($_SESSION['username'])) {
    header('location:login_form.php');
}

// Function to retrieve users data from file
function getUsersData()
{
    $filePath = 'users.txt';
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        if (!empty($content)) {
            return unserialize($content);
        }
    }
    return [];
}

// Get the logged-in user's name
function getLoggedInUserName()
{
    $username = $_SESSION['username'];
    $users = getUsersData();
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return $user['firstName'] . ' ' . $user['lastName'];
        }
    }
    return '';
}

// IF USER IS LOGGED IN = SHOWS LOGOUT IN NAV
if (isset($_SESSION['username'])) {
    $isLogged1 = true;
} else {
    $isLogged1 = false;
}

// IF USER IS NOT LOGGED IN = SHOWS LOGIN IN NAV
if (!isset($_SESSION['username'])) {
    $isLogged2 = true;
} else {
    $isLogged2 = false;
}
