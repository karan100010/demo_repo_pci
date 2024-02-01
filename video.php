<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Video Player</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
    .comment-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .comment-box {
        border: 1px solid #ced4da;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .comment-content {
        padding-left: 10px;
    }

    .username {
        font-weight: bold;
        color: #007bff;
    }

    .comment-text {
        color: #212529;
    }
</style>
    <style>
    .comment-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .comment-form .form-group {
        margin-bottom: 15px;
    }

    .comment-form .form-control {
        border-radius: 0;
        border: 1px solid #ced4da;
    }

    .comment-form .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .comment-form .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
    <style>
        .comment-text {
            margin: 0;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            line-height: 1.4;
        }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        video {
            width: 70%;
            height: auto;
            float: left;
        }
        .video-list {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f1f1f1;
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #f1f1f1;
            color: black;
            text-align: center;
        }

        /* CSS for smaller screens */
        @media screen and (max-width: 400px) {
            video {
                width: 100%;
                float: none;
            }
            .video-list {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    
    </style>
</head>
<body>
    <h1 id="heading">Video Player</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <video id="videoPlayer" controls>
                    <?php
                    // Retrieve the list of video files in the "videos/education" subfolder
                    $videoFolder = "videos/education/";
                    $videoFiles = glob($videoFolder . "*.mp4");

                    // Set the default video file as the first file in the list
                    $defaultVideoFile = $videoFiles[0] ?? '';

                    ?>
                    <source id="source" src="<?php echo $defaultVideoFile; ?>" type="video/mp4">
                    <!-- refresh the page each time src of source gets changed -->
                    
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="col-md-4">
                <div class="video-list">
                    <h2>List of Videos:</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="subfolder">Select Subfolder:</label>
                            <select name="subfolder" id="subfolder" class="form-control">
                                <?php
                                // Retrieve the list of subfolders in the "videos" folder
                                $subfolders = glob("videos/*", GLOB_ONLYDIR);

                                // Display each subfolder as an option in the dropdown
                                foreach ($subfolders as $subfolder) {
                                    $subfolderName = basename($subfolder);
                                    echo "<option value='$subfolderName'>$subfolderName</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                    <ul>
                    <?php
                    // Retrieve the selected subfolder from the form submission
                    if (isset($_POST['subfolder'])) {
                        $selectedSubfolder = $_POST['subfolder'];

                        // Retrieve the list of video files in the selected subfolder
                        $videoFolder = "videos/" . $selectedSubfolder . "/";

                        foreach (glob($videoFolder . "*.mp4") as $filename) {
                            // Extract the video file name from the path
                            $videoName = basename($filename, ".mp4");

                            // Display the video name as a link to load the video
                            echo "<li><a href='#' onclick='loadVideo(\"$filename\")'>$videoName</a></li>";
                        }
                    }

                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Comment Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                
                <?php
                // retrieve comments from comments.txt file where they are stored as a json object
                $comments = file_get_contents('comments.txt');
                $comments = json_decode($comments, true);
                // write comments in the browser as they appear in YouTube
                foreach ($comments as $comment) {
                   // echo $comment['filename'];
                   // echo "<br><br>".basename($defaultVideoFile);
                    //strip http://localhost/ from the filename
                    $name = str_replace("http://localhost/", "", $comment['filename']);
                    //replace %20 with space
                    $name = str_replace("%20", " ", $name);
                    //echo "<br><br>".$name;
                    if ($name === $defaultVideoFile) {
                        echo "<div class='comment-box'>";
                        echo "<div class='comment-content'>";
                        echo "<p class='username'>" . $comment['username'] . "</p>";
                        echo "<p class='comment-text'>" . $comment['comment'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <div class="col-md-4">
                <!-- Comment Form -->
                <!-- crate a new section for submit commnet -->
                <h2>Submit Comment</h2>
                <p>Please enter your name and a comment</p>
            
                <form class="comment-form" method="post" action="comment.php">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter your name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="comment" placeholder="Enter your comment" class="form-control">
                    </div>
                    <input type="hidden" name="filename" value="">
                    <div class="form-group">
                        <input type="submit" name="submit" value="Comment" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Footer Text</p>
    </div>
    <script>
    // Get the source element
    var form = document.querySelector('.comment-form');

    var source = document.getElementById('source');
form.addEventListener('submit', function(e) {
    // Get the filename input element
    var filenameInput = document.getElementsByName('filename')[0];
    console.log(filenameInput.value);
    console.log(source.src);

    // Set the value of the filename input to the source's src attribute
    filenameInput.value = source.src;});
</script>

    <script src="bootstrap.min.js"></script>

    <script>
        function loadVideo(url) {
            var video = document.getElementById("videoPlayer");
            var source = document.getElementById("source");
            source.setAttribute('src', url);
            video.load();
            video.play();
        }
    </script>
</body>
</html>
