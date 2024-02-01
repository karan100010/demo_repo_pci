<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Video Player</title>
    <style>
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
            margin-left: 75%;
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
    <div class="video-player">
        <video id="videoPlayer" controls>
            <source id="source" src="video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="video-list">
            <h2>List of Videos:</h2>
            <ul>
            <?php
            // Retrieve the list of video files
            $videoFolder = "videos/";

            foreach (glob($videoFolder . "*.mp4") as $filename) {
                // Extract the video file name from the path
                $videoName = basename($filename, ".mp4");

                // Display the video name as a link to load the video
                echo "<li><a href='#' onclick='loadVideo(\"$filename\")'>$videoName</a></li>";
            }
            ?>
            </ul>
        </div>
    </div>
    <div class="footer">
        <p>Footer Text</p>
    </div>

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
