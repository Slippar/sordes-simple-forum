	<div class=forumbody>
		<table class=catnames>
		  <tr>
			<th class=catname>Categories</th>
		  </tr>
		</table class=catnames>
		<div class=catview>
			<?php 
					require "includes/dbh.inc.php";
					$CatCheck = "SELECT * FROM categories";
					$result = $conn->query($CatCheck);
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<table class=cats>
									<tr>
										<td class=catsname> <a href='category.php?id=" . $row["idCategories"] . "'>" . $row["nameCategories"]. "</a> </td>
									</tr>
								  </table class=cats>";
						}
					} 
					else {
						echo "0 categories, dude";
					}
					$conn->close();
			?>
		</div class=catview>
	</div class=forumbody>
</body>