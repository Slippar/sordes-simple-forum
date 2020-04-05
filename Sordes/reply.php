<?php
//create_cat.php
include 'includes/dbh.inc.php';

session_start();
 
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    //someone is calling the file directly, cant do that
    echo 'This file cannot be called directly.';
}

if (!isset($_SESSION['userId'])) {
    echo 'No bueno, youre not logged in';
}
else {  
        //a real user posted a real reply
		$sql = "INSERT INTO 
                    posts(contentPost,
                          datePost,
                          topicPost,
                          byPost) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysqli_real_escape_string($conn, $_GET['id']) . ",
                        " . $_SESSION['userId'] . ")";
                         
        $result = mysqli_query($conn, $sql);
                         
        if(!$result) {
            echo 'Your reply has not been saved, please try again later.';
        }
        else {
			header("Location: topic.php?id=" . htmlentities($_GET['id']));
			exit();
        }

}
?>