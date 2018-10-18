<?php
// check if value was posted
  // include database and object file
	require_once('./includes/loaders.php');

    // set post id to be deleted
    $id = $post->id = $_GET['id'];
     
    // delete the post
    if($post->delete()){
        echo "Object was deleted.";
		header("location: index.php?id=$id");
		return true;
    }
     
    // if unable to delete the post
    else{
        echo "Unable to delete object.";
    }

?>