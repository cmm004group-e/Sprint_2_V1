<?php

// establish database connection
include_once '../config/database.php';

// instantiate user object
include_once '../classes/user_profile.php';

$database = new Database();
$db = $database->getConnection();

$user_profile = new User_profile($db);

// set user property values
$user_profile->telephone = $_POST['telephone'];
$user_profile->employer = $_POST['employer'];
$user_profile->role_description = $_POST['role_description'];
$user_profile->linkedin = $_POST['linkedin'];
$user_profile->github = $_POST['github'];
$user_profile->facebook = $_POST['facebook'];
$user_profile->instagram = $_POST['instagram'];
$user_profile->time_updated = date('Y-m-d H:i:s');

// create the user
if($user_profile->save()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Saved!",
        "id" => $user->id,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "profile already updated!"
    );
}
print_r(json_encode($user_arr));
?>