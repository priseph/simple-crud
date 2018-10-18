<?php 
require_once('./includes/loaders.php');


// if the form was submitted 
if($_POST){
 
    // set post property values
    $post->name = $_POST['name'];
    $post->description = $_POST['description'];
    $post->type_id = $_POST['type_id'];
    $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$post->image = $image;

 
    // create the post
    if($post->create()){
		// try to upload the submitted file
// uploadPhoto() method will return an error message, if any.
	echo $post->uploadPhoto();
        echo "Post was created.";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "Unable to create Post.";
    }
}

?>

<!DOCTYPE html>
<html>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
		
		<tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
		
		 <tr>
            <td>Type</td>
            <td>
            <?php
			// read the product categories from the database
			$stmt = $type->read();
			 
			// put them in a select drop-down
			echo "<select name='type_id'>";
				echo "<option>Select File Type...</option>";
			 
				while ($row_type = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row_type);
					echo "<option value='{$id}'>{$name}</option>";
				}
			 
			echo "</select>";
			?>
            </td>
        </tr>
		
        <tr>
			<td>Photo</td>
			<td><input type="file" name="image" /></td>
		</tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>

</body>
</html>
