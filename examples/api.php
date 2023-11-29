<link rel = "stylesheet" href = "styles.css"/>
<?php


// users JSON
$usersJSON = '../data/users.json';

// posts JSON
$postsJSON = '../data/posts.json';

// comments JSON
$commentsJSON = '../data/comments.json';

$signUp_popup = "success-popup";
$post_popup = "posted-popup";
$delete_popup = "delete-popup";
$invalid_popup = "errorDelete-popup";
$error_popup = "error-popup";
$login_popup = "login-popup";
function showPopup($popupId) {
    echo '<script>';
    echo 'var popup = document.getElementById("' . $popupId . '");';
    echo 'popup.style.display = "block";';
    echo 'setTimeout(function() { $("#' . $popupId . '").fadeOut();; }, 3000);';
    echo '</script>';
}

function registerUser()
{
    $name = $_POST["NAME"];
    $username = $_POST["USER-NAME"];
    $email = $_POST["EMAIL"];
    $street = $_POST["STREET"];
    $barangay = $_POST["BARANGAY"];
    $city = $_POST["CITY"];
//    echo $name . " ".$username . " ".$email . " ".$street . " ".$barangay . " ".$city;


    //gets the file
    $inp = file_get_contents('../data/users.json');

    //decodes the file
    $tempArray = json_decode($inp, true);
    $id = (end($tempArray))["id"];

    $obj = new stdClass();
    $obj->id = ++$id;
    $obj->name = $name;
    $obj->username = $username;
    $obj->email = $email;
    $obj->address = new stdClass();
    $obj->address->street = $street;
    $obj->address->barangay = $barangay;
    $obj->address->city = $city;

    $objVar = json_encode($obj);

    array_push($tempArray, $obj);
    $jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
    global $signUp_popup;
    showPopup($signUp_popup);
    file_put_contents('../data/users.json', $jsonData);


}

function setUsername($USERNAME)
{
    echo '<script>
           document.getElementById("userHere").innerText = "' . $USERNAME . '";
           </script>';
}

// function get users from json
function getUsersData()
{
    global $usersJSON;
    if (!file_exists($usersJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($usersJSON);
    return json_decode($data, true);
}

// function get posts from json
function getPostsData()
{
    global $postsJSON;
    if (!file_exists($postsJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($postsJSON);
    return json_decode($data, true);
}

// function get comments from json
function getCommentsData($id)
{
    global $commentsJSON;
    if (!file_exists($commentsJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($commentsJSON);
    $data = json_decode($data, true);
    if ($id == 0)
        return $data;
    else {
        $comments = array();
        foreach ($data as $comment) {
            if ($comment['postId'] == $id) {
                array_push($comments, $comment);
            }
        }
        return $comments;
    }
}



function getPosts($USERNAME)
{
    if ($USERNAME == 0) {
        $users = getUsersData();

        $posts = getPostsData();

        $comments = getCommentsData(0);

        $postsarr = array();

        foreach ($posts as $post) {
            foreach ($users as $user) {
                if ($user['id'] == $post['uid']) {
                    $post['uid'] = $user;

                    break;
                }
            }
            $post['comments'] = array();
            foreach ($comments as $comment) {
                if ($post['id'] == $comment['postId']) {
                    $post['comments'][] = $comment;
                }
            }
            $postarr[] = $post;
        }
        $str = "";
        foreach ($postarr as $parr) {
// See details
            //        echo '<pre>' . var_export($parr, true) . '</pre>';
            $str .= '<!-- start of post -->
    <div class="row">
        <div class="col-md-12">
            <div class="post-content">

              <div class="post-container">
                <img src="https://ui-avatars.com/api/?rounded=true&name=' . $parr['uid']['name'] . '" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">' . $parr['uid']['name'] . '</a></h5>
                  </div>
                  <div class="reaction">
                    <!--<a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>-->
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <h3>' . $parr['title'] . '</h3>
                    <p>' . $parr['body'] . '</p>
                  </div>
                  <div class="line-divider"></div>';
            foreach ($parr['comments'] as $comm)
                $str .= '<div class="post-comment">
                    <img src="https://ui-avatars.com/api/?rounded=true&name=' . $comm['name'] . '" alt="" class="profile-photo-sm">
                    <p>' . $comm['body'] . '</p>
                  </div>';


            $str .= '</div>

              </div>
              
            </div>
            
        </div>
    </div>';
        }
        return $str;
    } else {
        $users = getUsersData();

        $posts = getPostsData();

        $comments = getCommentsData(0);

        $postsarr = array();

        foreach ($posts as $post) {
            foreach ($users as $user) {
                if ($user['id'] == $post['uid']) {
                    $post['uid'] = $user;

                    break;
                }
            }
            $post['comments'] = array();
            foreach ($comments as $comment) {
                if ($post['id'] == $comment['postId']) {
                    $post['comments'][] = $comment;
                }
            }
            $postarr[] = $post;
        }
        $str = "";
        foreach ($postarr as $parr) {
                    // See details
            //        echo '<pre>' . var_export($parr, true) . '</pre>';
            $str .= '<!-- start of post -->
    <div class="row">
        <div class="col-md-12">
            <div class="post-content">

              <div class="post-container">
                <img src="https://ui-avatars.com/api/?rounded=true&name=' . $parr['uid']['name'] . '" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">' . $parr['uid']['name'] . '</a></h5>
                    
                  </div>
                 
                  <div class="reaction">
                    <!--<a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>-->
                    <form action = "index.php" method = "post">
                </form>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                  <div class="postTITLE" style="display: flex">
                    <h3>' . $parr['title'] . '</h3>
                  <form action = "index.php" method = "post">
    <input type = "submit" name = "deletePost" style= "
    background: #ffffff; border-radius: 10px; margin-left: 30px; font-size: 10px; color: black;width: 30px;"  value = "✘" >
    <input name = "postID" value = ' . $parr['id'] . ' hidden>
                </form>
                    </div>
                    
                    <p>' . $parr['body'] . '</p>
                  </div>
                  <div class="line-divider"></div>';
            foreach ($parr['comments'] as $comm)
                $str .= '<div class="post-comment">
                    <img src="https://ui-avatars.com/api/?rounded=true&name=' . $comm['name'] . '" alt="" class="profile-photo-sm">
                    <p>' . $comm['body'] . '</p>
                    <form action = "index.php" method = "post">
    <input type = "submit" name = "deleteReply" style= "
    background: #ffffff; border-radius: 5px; margin-left: 15px; font-size: 10px; color: black"  value = "✘" >
    <input name = "postID" value = ' . $comm['postId'] . ' hidden >
    <input name = "commentID" value = ' . $comm['id'] . ' hidden>
                </form>
                  </div>';


            $str .= '</div>
 <form action = "index.php" method = "post">
    <input type = "text" style="margin-left: 70px; margin-top: 10px; border-radius: 10px; font-family: Arial Nova,serif; width: 200px; " name = "replyComment" placeholder="  Enter reply..."  required pattern=".*\S+.*" title="Field cannot be blank"> 
    <input type = "submit" style= "background: #ffcd39; border-radius: 5px" id = "sendButton" value = "➤" >
    <input name = "replyCommentID" value = ' . $parr['id'] . ' hidden>
    </form>
              </div>
            </div>
            
           
        </div>
    </div>';
        }
        return $str;
    }
}

function deletePost($postID, $UID)
{
    if (isset($postID) &&isset($UID)) {
        $post = getPostsData();

        foreach ($post as $key => $value) {
            if ($value['id'] == $postID) {
                if($value['uid'] == $UID){
                    unset($post[$key]);
                    break;
                }else
                {
                    global $invalid_popup;
                    showPopup($invalid_popup);
                    return;
                }

            }
        }
        global $delete_popup;
        showPopup($delete_popup);
        $jsonData = json_encode($post, JSON_PRETTY_PRINT);
        file_put_contents('../data/posts.json', $jsonData);
    }
}

function deleteReply($postID, $replyID, $name)
{

    if (isset($replyID) && isset($postID) && isset($name)) {
        $comments = getCommentsData(0);

        foreach ($comments as $key => $comment) {
            if ($comment['id'] == $replyID && $comment['postId'] == $postID) {
                if($comment['name'] == $name){
                    unset($comments[$key]);
                    break;
                }else
                {
                    global $invalid_popup;
                    showPopup($invalid_popup);
//                    echo '<script>alert("Invalid. Cannot delete.")</script>';
                    return;
                }

            }
        }
        global $delete_popup;
        showPopup($delete_popup);

        $jsonData = json_encode($comments, JSON_PRETTY_PRINT);
        file_put_contents('../data/comments.json', $jsonData);

    }

}


?>

