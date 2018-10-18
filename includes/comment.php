<?php
class Comments{
 
    // database connection and table name
    private $conn;
    private $table_name = "comments";
 
    // object properties
    public $id;
    public $name;
    public $email;
    public $comment;
    public $post;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, comment=:comment, post=:post, created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->comment=htmlspecialchars(strip_tags($this->comment));
        $this->post=htmlspecialchars(strip_tags($this->post));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":comment", $this->comment);
        $stmt->bindParam(":post", $this->post);
        $stmt->bindParam(":created", $this->timestamp);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
	// used for paging comments
	public function countAll(){
	 
		$query = "SELECT id FROM " . $this->table_name . "";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		$num2 = $stmt->rowCount();
	 
		return $num2;
	}
	
	
		function readAll($from_record_num, $records_per_page){
 
		$query = "SELECT
					id, name, email, comment, post
				FROM
					" . $this->table_name . "
				ORDER BY
					id DESC
				LIMIT
					{$from_record_num}, {$records_per_page}";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		return $stmt;
	}

}
?>