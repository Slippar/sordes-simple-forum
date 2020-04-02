<?php
//create_cat.php
include 'includes/dbh.inc.php';
include 'header.php';
 
echo '<h2>Create a category</h2>';

if (!isset($_SESSION['userId'])) {
    //the user is not signed in
    echo 'Sorry, you have to be signed in to create a category.';
}

if ($_SESSION['userRole'] < 2) {
    //the user is not signed in
    echo 'Sorry, you need to have higher privileges to create a category';
}

else {
 
	if($_SERVER['REQUEST_METHOD'] != 'POST') {
		//the form hasn't been posted yet, display it
		echo "<form method='post' action=''>
			Category name: <input type='text' name='nameCategories' />
			Category description: <textarea name='descCategories' /></textarea>
			<input type='submit' value='Add category' />
		 </form>";
	}
	else {
		
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(nameCategories, descCategories)
		   VALUES ('" . (mysqli_real_escape_string($conn, $_POST['nameCategories'])) . 
				 "', '" . (mysqli_real_escape_string($conn, $_POST['descCategories'])) . "');";

		$result = mysqli_query($conn, $sql);
		
		if(!$result) {
			//something went wrong, display the error
			echo 'Error' . mysqli_error($conn);
		}
		else {
			echo 'New category successfully added.';
		}
	}
}
include "footer.php";
?>