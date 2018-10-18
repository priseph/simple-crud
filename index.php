<?php 
require_once('./includes/loaders.php');



// set page header
$page_title = "Read Post";
?>
<!DOCTYPE html>
<html>
<body>
<a href='create-post.php' >Create Post</a>
<?php
// display the post if there are any
if($num>0){
 
    echo "<table>";
        echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Image</th>";
            echo "<th>Description</th>";
            echo "<th>Type</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td><img src='uploads/{$image}' style='width:100px;' />" ;
                echo "<td>{$description}</td>";
                echo "<td>";
                    $type->id = $type_id;
                    $type->readName();
                    echo $type->name;
                echo "</td>";
 
                echo "<td>";
                    // view post button
				echo "<a href='view-post.php?id={$id}' class='btn btn-primary left-margin'>";
					echo "<span class='glyphicon glyphicon-list'></span> View";
				echo "</a>";
				 
				// edit post button
				echo "<a href='update-post.php?id={$id}' class='btn btn-info left-margin'>";
					echo "<span class='glyphicon glyphicon-edit'></span> Edit";
				echo "</a>";
				 
				// delete post button
				echo "<a href='delete-post.php?id={$id}' class='btn btn-danger delete-object'>";
					echo "<span class='glyphicon glyphicon-remove'></span> Delete";
				echo "</a>";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
	// the page where this paging is used
	$page_url = "index.php?";
	 
	// count all products in the database to calculate total pages
	$total_rows = $post->countAll();
	 
	// paging buttons here
	include_once 'includes/paging.php';
    // paging buttons will be here
}
 
// tell the user there are no products
else{
    echo "No products found.";
}
?>

</body>
</html>
