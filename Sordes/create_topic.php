<?php
//create_topic.php
include 'includes/dbh.inc.php';
include 'header.php';
 
echo '<h2>Create a topic</h2>';

if(!isset($_SESSION['userUid'])) {
    //the user is not signed in
    echo 'Sorry, you have to be signed in to create a topic.';
}

else {
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST') {   
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    idCategories,
                    nameCategories,
                    descCategories
                FROM
                    categories";
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result) {
            //the query failed, FUCK
            echo 'Error while selecting from database. Please try again later.';
        }
        else {
            if(mysqli_num_rows($result) == 0) {
                //there are no categories, so a topic can't be posted
                    echo 'Before you can post a topic, you must wait for an admin or a moderator to create some categories.';
                
            }
            else {
         
                echo '<form method="post" action="">
                    Subject: <input type="text" name="subjectTopics" />
                    Category:'; 
                 
                echo '<select name="catTopics">';
                    while($row = mysqli_fetch_assoc($result)) {
						echo '1';
                        echo '<option value="' . $row['idCategories'] . '">' . $row['nameCategories'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo 'Message: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($conn, $query);
         
        if(!$result) {
            //Damn! the query failed, quit
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else {
     
            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll save the post into the posts table
            $sql = "INSERT INTO 
                        topics(subjectTopics,
                               dateTopics,
                               catTopics,
                               byTopics)
                   VALUES('" . mysqli_real_escape_string($conn, $_POST['subjectTopics']) . "',
                               NOW(),
                               " . mysqli_real_escape_string($conn, $_POST['catTopics']) . ",
                               " . $_SESSION['userId'] . "
                               )";
                      
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($conn);
                $sql = "ROLLBACK;";
                $result = mysqli_query($conn, $sql);
            }
            else {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created topic for usage in the posts query
                $topicid = mysqli_insert_id($conn);
                 
                $sql = "INSERT INTO
                            posts(contentPost,
                                  datePost,
                                  topicPost,
                                  byPost)
                        VALUES
                            ('" . mysqli_real_escape_string($conn, $_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['userId'] . "
                            )";
                $result = mysqli_query($conn, $sql);
                 
                if(!$result) {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($conn);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($conn, $sql);
                }
                else {
                    $sql = "COMMIT;";
                    $result = mysqli_query($conn, $sql);
                     
                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    }
}
 
include 'footer.php';
?>