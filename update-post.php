<?php 

// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
require_once('./includes/loaders.php');

// set ID property of product to be edited
$post->id = $id;
 
// read the details of product to be edited
$post->readOnePost();
 

// 'update product' form will be here 
 
// set page header
$page_title = "Update Post";

// if the form was submitted
if($_POST){
 
    // set post property values
    $post->name = $_POST['name'];
    $post->image = $_POST['file'];
    $post->description = $_POST['description'];
    $post->type_id = $_POST['type_id'];
 
    // update the post
    if($post->update()){
            echo "Post was updated.";
    }
 
    // if unable to update the post, tell the user
    else{
            echo "Unable to update post.";
    }
}

?>

<!DOCTYPE html>
<html>
<body>
    <a href='index.php' >View Posts</a>

<br>
<!-- post code will be here -->
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $post->name; ?>'  /></td>
        </tr>
		
		<tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo $post->description; ?></textarea></td>
        </tr>
		
		 <tr>
            <td>Type</td>
            <td>
			<?php
			$stmt = $type->read();
			 
			// put them in a select drop-down
			echo "<select class='form-control' name='type_id'>";
			 
				echo "<option>Please select...</option>";
				while ($row_type = $stmt->fetch(PDO::FETCH_ASSOC)){
					$type_id=$row_type['id'];
					$type_name = $row_type['name'];
			 
					// current type of the product must be selected
					if($post->type_id==$type_id){
						echo "<option value='$type_id' selected>";
					}else{
						echo "<option value='$type_id'>";
					}
			 
					echo "$type_name</option>";
				}
			echo "</select>";
			?>
            </td>
        </tr>

        <tr>
		
            <td>
			
			<?php echo $post->image ? "<img src='uploads/{$post->image}' style='width:100px;' />" : "No image found."; ?>
			</td>
            <td>Change Image<br><input type="file" name="file" id="file"></td>
        </tr>
 
    
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>

</body>
</html>
