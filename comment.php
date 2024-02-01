<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $comment = $_POST["comment"];
        $filename = $_POST["filename"];
        echo $filename; 

        // Call your function to save the comment
        save_comment($username, $comment,$filename);

        // Redirect to videos.php
        header("Location: video.php");
        exit;
    }
    function get_comments() {
        // Get comments from comments.txt
        $comments = file_get_contents("comments.txt");

        // Convert the comments from json to an array
        $comments = json_decode($comments, true);

        // If there are no comments, initialize an empty array
        if ($comments == null) {
            $comments = [];
        }

        // Return the array of comments
        return $comments;
    }

    // Function to save comment
    function save_comment($username, $comment, $filename) {
        // Get the existing comments
        $comments = get_comments();

        // Unshift new comment to the front of the array
        array_unshift($comments, [
            "username" => $username,
            "comment" => $comment,
            "datetime"=> date('Y-m-d H:i:s'),
            "filename" => $filename

        ]);

        // Save the comments
        file_put_contents("comments.txt", json_encode($comments));
    }
    
?>