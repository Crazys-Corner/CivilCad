<?php 
require("forum-backend.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Forum - Simple Reddit-like</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        h2 {
            margin-bottom: 0;
        }
        .thread {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .comment {
            border: 1px solid #eee;
            padding: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Forum - Simple Reddit-like</h1>
    <?php if (isset($_SESSION['username'])): ?>
        <form method="post" action="forum.php">
            <label for="thread_title">Thread Title:</label>
            <input type="text" name="thread_title" required><br><br>

            <label for="thread_content">Thread Content:</label><br>
            <textarea name="thread_content" required></textarea><br><br>

            <input type="submit" name="submit_thread" value="Post Thread">
        </form>
    <?php else: ?>
        <p>You need to log in to post a thread or comment.</p>
    <?php endif; ?>

    <?php foreach ($threads as $thread): ?>
        <div class="thread">
            <h2><?php echo $thread['title']; ?></h2>
            <p><?php echo $thread['content']; ?></p>
            <p>Posted by: <?php echo $thread['author']; ?></p>

            <?php
            // Display comments for this thread
            // Implement a function to get comments for a specific thread from the database.
            // Loop through the comments and display them inside each thread div.
            // $comments = getCommentsForThread($thread['id']);
            // foreach ($comments as $comment):
            ?>
                <!-- Uncomment the code below to display comments -->
                <!-- <div class="comment">
                    <p><?php //echo $comment['content']; ?></p>
                    <p>Posted by: <?php //echo $comment['author']; ?></p>
                </div> -->
            <?php //endforeach; ?>

            <?php if (isset($_SESSION['username'])): ?>
                <!-- Uncomment the code below to add comment form for each thread -->
                <!-- <form method="post" action="forum.php">
                    <input type="hidden" name="thread_id" value="<?php //echo $thread['id']; ?>">
                    <label for="comment_content">Add Comment:</label><br>
                    <textarea name="comment_content" required></textarea><br><br>

                    <input type="submit" name="submit_comment" value="Post Comment">
                </form> -->
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
