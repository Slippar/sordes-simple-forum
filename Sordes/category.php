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
        //display category data
        while($row = mysqli_fetch_assoc($result)) {
            echo '<h2>Topics in ′' . $row['nameCategories'] . '′ category</h2>';
        }
     
        //do a query for the topics
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
                //prepare the table
                echo '<table class="topicviewtop">
                      <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result)) {               
                    echo '<table class="topicview">
						  <tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topic.php?id=' . $row['idTopics'] . '">' . $row['subjectTopics'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['dateTopics']));
                        echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}
 // include footer later when shits fixed thanks
?>