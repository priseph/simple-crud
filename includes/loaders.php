<?php

// include database and object files
include_once 'includes/config.php';
include_once 'includes/post.php';
include_once 'includes/type.php';
include_once 'includes/comment.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$post = new Posts($db);
$type = new Type($db);
$comment = new Comments($db);

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// query post
$stmt = $post->readAll($from_record_num, $records_per_page);
$stmt2 = $comment->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
$num2 = $stmt->rowCount();

?>