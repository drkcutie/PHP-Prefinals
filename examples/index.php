<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Include modal, header, and API files
include("modal.php");
include("header.php");
include("api.php");
if(isset($_SESSION['user']) && !isset($_POST["user-name"]))
{
    $username = $_SESSION['user']['name'];
    setUsername($username);

}
// Check if user is logged in
if (isset($_POST["user-name"])) {
    $username = $_POST["user-name"];
    $inp = file_get_contents('../data/users.json');
    // Decode the file
    $tempArray = json_decode($inp, true);
    $nameFound = false;

    // Iterate through users to find the username
    foreach ($tempArray as $key => $value) {
        if ($value['name'] == $username) {
            $nameFound = true;
            // Store user data in the session
            $_SESSION['user'] = $value;
            echo '<script> console.log("Successfully Login!")</script>';
            echo '<script>
                document.getElementById("userHere").innerText = "' . $username . '";
                </script>';
            global $login_popup;
            showPopup($login_popup);
            break;
        }
    }

    if (!$nameFound) {
        // Check if the session has a user
        $username = "";
        $_SESSION = [];
        global $error_popup;
       showPopup($error_popup);
    }
}

// Register user if registration form is submitted
if (isset($_POST["NAME"]) && isset($_POST["USER-NAME"]) && isset($_POST["EMAIL"]) && isset($_POST["STREET"]) && isset($_POST["BARANGAY"]) && isset($_POST["CITY"])) {
    echo registerUser();
}

// Process comment and post data
if (isset($_SESSION['user']) && isset($_POST["commentArea"]) && isset($_POST["titleBox"])) {
    $title = $_POST["titleBox"];
    $comment = $_POST["commentArea"];
    $username = $_SESSION['user']['name'];
    $post = getPostsData();
    $postID = end($post)['id'] + 1;
    $userID = $_SESSION['user']['id'];

    $obj = new stdClass();
    $obj->uid = $userID;
    $obj->id = $postID;
    $obj->title = $title;
    $obj->body = $comment;

    array_push($post, $obj);
    $jsonData = json_encode($post, JSON_PRETTY_PRINT);
    file_put_contents('../data/posts.json', $jsonData);
    global $post_popup;
    showPopup($post_popup);
    setUsername($username);
}

// Process reply comment
if (isset($_POST['replyComment']) && trim($_POST['replyComment']) != "") {
    $username = $_SESSION['user']['name'];
    $body = $_POST['replyComment'];
    $postId = $_POST['replyCommentID'];
    $comments = getCommentsData(0);
    $replyID = count(getCommentsData($postId)) + 1;

    $obj = new stdClass();
    $obj->postId = $postId;
    $obj->id = $replyID;
    $obj->name = $_SESSION['user']['name'];
    $obj->email = $_SESSION['user']['email'];
    $obj->body = $body;

    array_push($comments, $obj);

    $jsonData = json_encode($comments, JSON_PRETTY_PRINT);
    file_put_contents('../data/comments.json', $jsonData);
}
if(isset($_POST['deleteReply']))
{
    $username = $_SESSION['user']['name'];
    $postID = $_POST['postID'];
    $commentID =  $_POST['commentID'];
    deleteReply($postID, $commentID, $username);
    setUsername($username);
}
if(isset($_POST['deletePost']))
{
    $username = $_SESSION['user']['name'];
    $uid = $_SESSION['user']['id'];
    $postID = $_POST['postID'];
    deletePost($postID, $uid);
    setUsername($username);
}
?>

<!--Display posts based on user login status-->
<div class="container">
    <?php
    if (empty($username)) {
        echo getPosts(0);
    } else {
        echo getPosts($_SESSION['user']['name']);
    }
    ?>
</div>

</body>
</html>
