	<div class=forumbody>
		<table class=CatTopPost>
		  <tr>
			<th class=CatName>Category</th>
			<th class=TopicName>Topics</th>
			<th class=PostName>Posts</th>
		  </tr>
		</table class=CatTopPost>
		<div class=dod>
			<?php 
					require "includes/dbh.inc.php";
					$CatCheck = "SELECT * FROM categories";
					$result = $conn->query($CatCheck);
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<table class=Cats><tr><th class=CatsName>" . 
							$row["nameCategories"]. "</th class=CatsName></tr></table class=Cats>";
						}
					} else {
						echo "0 categories, dude";
					}
					$conn->close();
			?>
		</div class=dod>
	</div class=forumbody>