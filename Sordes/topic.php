<?php
//create_cat.php
include 'includes/dbh.inc.php';
include 'header.php';
 

$sql = "SELECT
			idTopics,
			subjectTopics
		FROM
			topics
		WHERE
			idTopics = " . mysqli_real_escape_string($conn, $_GET['id']) . ';';
 
$result = mysqli_query($conn, $sql);
 
if(!$result) {
    echo 'The topic could not be displayed, please try again later.' . mysqli_error($conn);
}

else {
	
    if(mysqli_num_rows($result) == 0) {
        echo 'no replies, tell admin hes a fuckhead';
    }
	
    else {
        $sql = "SELECT  
                    topicPost,
					contentPost,
					datePost,
					byPost,
					idUsers,
					uidUsers
                FROM
                    posts
				LEFT JOIN
					users
				ON
					posts.byPost = users.idUsers
                WHERE
                    topicPost = " . mysqli_real_escape_string($conn, $_GET['id']) . ';';
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result) {
            echo 'The posts could not be displayed, please try again later.';
        }
		
        else {
                echo '<table class="topictable1">
                      <tr>
						<th class="userrr">User</th>
						<th class="replyyy">Reply</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result)) { 				
                    echo '<table class="topictable2">
						   <tr>';
                        echo '<td class="postleftpart">';
                            echo $row['uidUsers'] . " " . $row['datePost'];
                        echo '</td>';
                        echo '<td class="postrightpart">';
                            echo $row['contentPost'];
                        echo '</td>';
                    echo '</tr>';
                }
				
				echo "</table class='topictable1'> </table class='topictable2'>";
				
				
				if (isset($_SESSION['userId'])) {
					echo '	Reply:
							<form class="SendReply" action="reply.php?id=' . $_GET['id'] . '" method="post">
								<textarea name="reply-content" placeholder="Your reply..."></textarea>
								<button type="submit" name="reply-submit">Submit reply</button>
							</form>';
				}
				else {
					echo 'Sign in to reply!';
				}
            
        }
    }
}
include "footer.php";
?>
