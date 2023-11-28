<?php


// users JSON
$usersJSON = '../data/users.json';

// posts JSON
$postsJSON = '../data/posts.json';

// comments JSON
$commentsJSON = '../data/comments.json';


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
    $jsonData = json_encode($tempArray,JSON_PRETTY_PRINT);

    file_put_contents('../data/users.json', $jsonData);


}

// function get users from json
function getUsersData() {
    global $usersJSON;
    if (!file_exists($usersJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($usersJSON);
    return json_decode($data, true);
}

// function get posts from json
function getPostsData() {
    global $postsJSON;
    if (!file_exists($postsJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($postsJSON);
    return json_decode($data, true);
}

// function get comments from json
function getCommentsData() {
    global $commentsJSON;
    if (!file_exists($commentsJSON)) {
        echo 1;
        return [];
    }

    $data = file_get_contents($commentsJSON);
    return json_decode($data, true);
}


function getPosts(){

    $users = getUsersData();
    
    $posts = getPostsData();
    
    $comments = getCommentsData();
    
    $postsarr = array();
    
    foreach($posts as $post){
        foreach($users as $user){
            if($user['id'] == $post['uid']){
                $post['uid'] = $user;
                
                break;
            }
        }
        $post['comments'] = array();
        foreach($comments as $comment){
            if($post['id']==$comment['postId']){
                $post['comments'][] = $comment;
            }
        }
        $postarr[] = $post;
    }
    $str = "";
    foreach($postarr as $parr){
// See details
        //        echo '<pre>' . var_export($parr, true) . '</pre>';
 $str.='<!-- start of post -->
    <div class="row">
        <div class="col-md-12">
            <div class="post-content">

              <div class="post-container">
                <img src="https://ui-avatars.com/api/?rounded=true&name='.$parr['uid']['name'].'" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">'. $parr['uid']['name'] .'</a></h5>
                  </div>
                  <div class="reaction">
                    <!--<a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>-->
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <h3>'.$parr['title'].'</h3>
                    <p>'.$parr['body'].'</p>
                  </div>
                  <div class="line-divider"></div>';
        foreach($parr['comments'] as $comm)
                $str .=  '<div class="post-comment">
                    <img src="https://ui-avatars.com/api/?rounded=true&name='.$comm['name'].'" alt="" class="profile-photo-sm">
                    <p>'.$comm['body'].'</p>
                  </div>';
                 
                  
    $str.='</div>
              </div>
            </div>
        </div>
    </div>';
    }
return $str;
}

?>