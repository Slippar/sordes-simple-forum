	<div class=forumbody>
		<table class=Catnames>
		  <tr>
			<td class=CatName>Category</td>
		  </tr>
		</table class=Catnames>
		<div class=catview>
			<?php 
					require "includes/dbh.inc.php";
					$CatCheck = "SELECT * FROM categories";
					$result = $conn->query($CatCheck);
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<table class=Cats>
									<tr>
										<td class=CatsName> <a href='category.php?id=" . $row["idCategories"] . "'>" . $row["nameCategories"]. "</a> </td class=CatsName>
									</tr>
								  </table class=Cats>";
						}
					} 
					else {
						echo "0 categories, dude";
					}
					$conn->close();
			?>
		</div class=catview>
	</div class=forumbody>