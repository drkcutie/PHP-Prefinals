<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel='stylesheet' href='styles.css'>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>
<?php
include ("modal.php");
include("api.php");
include ("header.php");


if (isset($_POST["user-name"])) {
    $username = $_POST["user-name"];
    $inp = file_get_contents('../data/users.json');
    //decodes the file
    $tempArray = json_decode($inp, true);
    $nameFound = false;

    foreach ($tempArray as $key => $value) {
        if ($value['name'] == $username) {
            $nameFound = true;
            // Store user data in the session
            $_SESSION['user'] = $value;
            echo '<script> console.log("Successfully Login!")</script>';
            echo '<script>
            document.getElementById("userHere").innerText = "' . $username . '";
            </script>';
            break;
        }
    }

    if (!$nameFound) {
        // Check if the session has a user
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']['name'];
        } else {
            $username = "";
        }
        echo '<script>alert("Name not found")</script>';
    }
}

if (isset($_POST["NAME"]) && isset($_POST["USER-NAME"]) && isset($_POST["EMAIL"]) && isset($_POST["STREET"]) && isset($_POST["BARANGAY"]) && isset($_POST["CITY"])) {
    echo registerUser();
}

if(isset($_SESSION['user']) && isset($_POST["commentArea"]) && isset($_POST["titleBox"]))
{
    $title = $_POST["titleBox"];
    $comment = $_POST["commentArea"];

    $post = getPostsData();
    $postID = end($post)['id'];
    $postID++;
    $array = getUsersData();
    $userID = $_SESSION['user']['id'];

    $obj = new stdClass();
    $obj->uid = $userID;
    $obj->id = $postID;
    $obj->title = $title;
    $obj->body = $comment;


    array_push($post, $obj);
    $jsonData = json_encode($post,JSON_PRETTY_PRINT);

    file_put_contents('../data/posts.json', $jsonData);

}
?>



<div class="container">

    <?php

    echo getPosts();
    ?>
</div>
</body>
</html>
