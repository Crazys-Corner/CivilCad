<?php 
require("forum-backend.php"); 
require ("verify.php");
session_start();

// Check if the form for posting a new thread was submitted
if (isset($_POST['submit_thread'])) {
    $thread_title = $_POST['thread_title'];
    $thread_content = $_POST['thread_content'];
    $thread_author = $_SESSION['cadusername']; // Assuming this is the username

    // Call the function to create a new thread
    createThread($thread_title, $thread_content, $thread_author);
    
    // Redirect the user to the forum page after posting the thread
    header("Location: forum.php");
    exit();
}
if (isset($_GET['submit_search'])) {
    $search_query = $_GET['search_query'];
    // Call a function to search for threads based on the query
    $threads = searchThreads($search_query);
}

// Check if the form for posting a new comment was submitted
if (isset($_POST['submit_comment'])) {
    $comment_content = $_POST['comment_content'];
    $comment_author = $_SESSION['cadusername']; // Assuming this is the username
    $thread_id = $_POST['thread_id']; // Get the thread_id from the hidden input

    // Call the function to create a new comment
    createComment($thread_id, $comment_content, $comment_author);
    
    // Redirect the user to the forum page after posting the comment
    header("Location: forum.php");
    exit();
}
$threads = getAllThreads();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Forums</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
        }
        h2 {
            margin: 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
        }
        .thread {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #ffffff;
        }
        .comment {
            border: 1px solid #eee;
            padding: 10px;
            margin: 5px 0;
            background-color: #f9f9f9;
        }
        .comment p {
            margin: 0;
        }
        .form-container {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #ffffff;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container textarea,
        .form-container input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-message {
            margin-top: 20px;
            text-align: center;
            color: #777777;
        }
    </style>
</head>
<body>
    <h1><a style="color: #007bff;" href="index.php">Forms</a></h1>
    <?php if (isset($_SESSION['cadusername'])): ?>
        <div class="form-container">
            <h2>Post a New Thread</h2>
            <form method="post" action="forum.php">
                <label for="thread_title">Thread Title:</label>
                <input type="text" name="thread_title" required>

                <label for="thread_content">Thread Content:</label>
                <textarea name="thread_content" required></textarea>

                <input type="submit" name="submit_thread" value="Post Thread">
            </form>
        </div>
    <?php else: ?>
        <p class="login-message">You need to log in to post a thread or comment.</p>
    <?php endif; ?>
    <form method="get" action="forum.php">
    <label for="search_query">Search Threads:</label>
    <input type="text" name="search_query" required>
    <input type="submit" name="submit_search" value="Search">
</form>
    <?php foreach ($threads as $thread): ?>
        <div class="thread">
            <h2><?php echo $thread['title']; ?></h2>
            <p><?php echo $thread['content']; ?></p>
            <p>Posted by: <?php echo $thread['author']; ?></p>

            <?php
            // Display comments for this thread
            $comments = getCommentsForThread($thread['thread_id']);
            if (!empty($comments)) {
                foreach ($comments as $comment):
            ?>
                <div class="comment">
                    <p><?php echo $comment['content']; ?></p>
                    <p>Posted by: <?php echo $comment['author']; ?></p>
                </div>
            <?php endforeach; ?>
            <?php } else { ?>
                <p>No comments for this thread yet.</p>
            <?php } ?>

            <?php if (isset($_SESSION['cadusername'])): ?>
                <div class="form-container">
                    <form method="post" action="forum.php">
                        <input type="hidden" name="thread_id" value="<?php echo $thread['thread_id']; ?>">
                        <label for="comment_content">Add Comment:</label>
                        <textarea name="comment_content" required></textarea>
                        <input type="submit" name="submit_comment" value="Post Comment">
                    </form> 
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
