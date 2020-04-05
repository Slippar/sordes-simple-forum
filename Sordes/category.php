<?php
include 'includes/dbh.inc.php';
include 'header.php';
 
$sql = "SELECT
            idCategories,
            nameCategories,
            descCategories
        FROM
            categories
        WHERE
            idCategories = " . mysqli_real_escape_string($conn, $_GET['id']) . ';';
 
$result = mysqli_query($conn, $sql);
 
if(!$result) {
    echo 'The category could not be displayed, please try again later.' . mysqli_error($conn);
}
else {
    if(mysqli_num_rows($result) == 0) {
        echo 'This category does not exist.';
    }
    else {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<table class="categorylocation"> <th>Topics in ' . $row['nameCategories'] . ' category </th></tableclass="categorylocation"> ';
        }
     
        $sql = "SELECT  
                    idTopics,
                    subjectTopics,
                    dateTopics,
                    catTopics
                FROM
                    topics
                WHERE
                    catTopics = " . mysqli_real_escape_string($conn, $_GET['id']);
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result) {
            echo 'The topics could not be displayed, please try again later.';
        }
		
        else {
			
            if(mysqli_num_rows($result) == 0) {
                echo 'There are no topics in this category yet.';
            }
			
            else{
                echo '<table class="topicviewtop">
                      <tr>
                        <th class="lefttopic">Topic</th class="lefttopic">
                        <th class="righttopictime">Created at</th class="righttopictime">
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result)) {               
                    echo '<table class="topicview">
						  <tr>';
                        echo '<td class="leftpart">';
                            echo '<a href="topic.php?id=' . $row['idTopics'] . '">' . $row['subjectTopics'] . '</a>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['dateTopics']));
                        echo '</td>';
                    echo '</tr>';
                }
				echo "</table class='topicviewtop'> </table class='topicview'>";
            }
        }
    }
}
include "footer.php";
?>
