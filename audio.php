<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>VLC Style Audio Player</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1f1f1f;
            color: #fff;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            text-align: center;
        }

        audio {
            width: 100%;
            margin: 20px auto;
        }

        .controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .control-button {
            background-color: #212121;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .control-button:hover {
            background-color: #444;
        }

        .volume-slider {
            width: 150px;
            margin: 0 10px;
        }

        .volume-slider input[type=range] {
            width: 100%;
            height: 5px;
            -webkit-appearance: none;
            background: #555;
            outline: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .volume-slider input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 10px;
            height: 10px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
        }

        .volume-slider input[type=range]::-webkit-slider-thumb:hover {
            background: #fff;
        }

        .audio-list {
            margin-top: 20px;
        }

        .audio-list ul {
            list-style-type: none;
            padding: 0;
        }

        .audio-list ul li {
            margin: 5px 0;
        }

        .audio-list ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .audio-list ul li a:hover {
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Local audio player</h1>
        <?php
        $audioFolder = "audio/";
        $audioFiles = glob($audioFolder . "*.mp3");

        if (count($audioFiles) > 0) {
            $firstAudioFile = $audioFiles[0];
        ?>
        <audio id="audioPlayer" controls>
            <source src="<?php echo isset($_GET['file']) ? $_GET['file'] : ''; ?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <?php
        } else {
            echo "<p>No audio files found.</p>";
        }
        ?>
        <div class="controls">
            <button class="control-button" id="playPauseButton">&#9658;</button>
            <button class="control-button" id="stopButton">&#9632;</button>
            <input type="range" class="volume-slider" id="volumeSlider" min="0" max="1" step="0.01" value="1">
        </div>
        <div class="audio-list">
            <h2>List of Audio Files:</h2>
            <ul>
            <?php
            // Retrieve the list of audio files
            $audioFolder = "audio/";

            foreach (glob($audioFolder . "*.mp3") as $filename) {
                // Extract the audio file name from the path
                $audioName = basename($filename, ".mp3");

                // Display the audio name as a link to load the audio
                echo "<li><a href='?file=$filename'>$audioName</a></li>";
            }
            ?>
            </ul>
        </div>
    </div>

    <script>
        var audio = document.getElementById("audioPlayer");
        var playPauseButton = document.getElementById("playPauseButton");
        var stopButton = document.getElementById("stopButton");
        var volumeSlider = document.getElementById("volumeSlider");

        playPauseButton.addEventListener("click", function() {
            if (audio.paused) {
                audio.play();
                playPauseButton.innerHTML = "&#10074;&#10074;"; // Pause icon
            } else {
                audio.pause();
                playPauseButton.innerHTML = "&#9658;"; // Play icon
            }
        });

        stopButton.addEventListener("click", function() {
            audio.pause();
            audio.currentTime = 0;
            playPauseButton.innerHTML = "&#9658;"; // Play icon
        });

        volumeSlider.addEventListener("input", function() {
            audio.volume = volumeSlider.value;
        });
    </script>
</body>
</html>
