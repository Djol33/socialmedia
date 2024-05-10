<?php

if (!empty($res)) {
    // If there are comments, iterate over them
    foreach ($res as $comment) {


        echo "Creator: " .$comment['creator_id'] . "<br>";
        echo "Content: ".$comment['content'] . "<br>";
        // Add more code to display other comment details

        echo "<hr>"; // Add a separator between comments
    }
} else {
    // If there are no comments, display a message
    echo "No comments found.";
}
?>