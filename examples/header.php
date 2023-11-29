<link rel = "stylesheet" href = "styles.css"/>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="post.php" class="nav-link px-2 text-white">Posts</a></li>
            </ul>


            <div class="text-end">
                <button type="button" class="btn btn-outline-light me-2" id="loginPage" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Login
                </button>
                <button type="button" class="btn btn-warning" id="signupPage" data-bs-toggle="modal"
                        data-bs-target="#registerArea">Sign-up
                </button>
            </div>

        </div>

    </div>

</header>

<div class="container">
    <form action=index.php method="post">
        <div id="postComment">

            <label >Post Comment here:</label>
            <input type="text" name = "titleBox"  placeholder="Enter title..."  required pattern=".*\S+.*" title="Field cannot be blank"/>
            <textarea name="commentArea" id="commentArea" rows="4" cols="50" style="max-height: 100px; min-height: 50px; height: 70px" required></textarea>
            <br>
            <input type="submit" value="Submit">
        </div>
    </form>

</div>


