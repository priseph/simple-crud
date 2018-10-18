<?php

 // get ID of the post to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
// include database and object files
require_once('./includes/loaders.php');

// set ID property of post to be edited
$post->id = $id;
 
// read the details of post to be edited
$post->readOnePost();

// set page headers
$page_title = "View One Post";
 

// if the form was submitted 
 if(isset($_POST['createComment'])){
    // set comment property values
    $comment->name = $_POST['name'];
	$comment->email = $_POST['email'];
    $comment->comment = $_POST['comments'];
    $comment->post = $_POST['post'];
 
    // create the comment
    if($comment->create()){
		// try to upload the submitted file
        echo "Comment was created.";
    }
 
    // if unable to create the comment, tell the user
    else{
        echo "Unable to create Comment.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<a href='index.php'> Read Posts</a>

<br>
<?php
// HTML table for displaying a post details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Name:</td>";
        echo "<td>{$post->name}</td>";
    echo "</tr>";
 
   
   
 
    echo "<tr>";
        echo "<td>Type:</td>";
        echo "<td>";
            // display type name
            $type->id=$post->type_id;
            $type->readName();
            echo $type->name;
        echo "</td>";
    echo "</tr>";
	 echo "<tr>";
    echo "<td>Image:</td>";
    echo "<td>";
        echo $post->image ? "<img src='uploads/{$post->image}' style='width:100px;' />" : "No image found.";
    echo "</td>";
	echo "</tr>";
	 echo "<tr>";
        echo "<td>Description:</td>";
        echo "<td>{$post->description}</td>";
    echo "</tr>";
echo "</table>";
?>
<br><br>
<?php
// display the post if there are any
if($num2>0){
 
    echo "<table>";
 
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
			
 echo "<div>";
            extract($row);
				echo "<tr>";
				echo "<td>Name: {$name}</td>";
				
				echo "<td>Email: {$email}</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan='2'>Comment: <br>{$comment}<hr></td>";
                echo "</tr>";
 
            echo "</div>";
			
 
        }
 
    echo "</table>";
	

}
 
// tell the user there are no products
else{
    echo "No Comment found.";
}
?>

<br><br>

Drop a Comment Here:
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=".$_GET['id']);?>" method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
			<input type='hidden' name='post' value ="<?php echo $_GET['id'] ?>" />
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
		
		<tr>
            <td>Email</td>
            <td><input type='text' name='email' class='form-control' /></td>
        </tr>
		
		<tr>
            <td>Comment</td>
            <td><textarea name='comments' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" name="createComment" class="btn btn-primary">Submit Comment</button>
            </td>
        </tr>
 
    </table>
</form>

<!-- post code will be here -->
<br><br>
