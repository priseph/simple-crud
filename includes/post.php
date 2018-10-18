<?php
class Posts{
 
    // database connection and table name
    private $conn;
    private $table_name = "posts";
 
    // object properties
    public $id;
    public $name;
    public $image;
    public $description;
    public $type_id;
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
                    name=:name, image=:image, description=:description, type_id=:type_id, created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->type_id=htmlspecialchars(strip_tags($this->type_id));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":type_id", $this->type_id);
        $stmt->bindParam(":created", $this->timestamp);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
	function readAll($from_record_num, $records_per_page){
 
		$query = "SELECT
					id, name, description, image, type_id
				FROM
					" . $this->table_name . "
				ORDER BY
					name ASC
				LIMIT
					{$from_record_num}, {$records_per_page}";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		return $stmt;
	}
	
	// used for paging posts
	public function countAll(){
	 
		$query = "SELECT id FROM " . $this->table_name . "";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		$num = $stmt->rowCount();
	 
		return $num;
	}
	
	
	function readOnePost(){
 
		$query = "SELECT
					name, image, description, type_id
				FROM
					" . $this->table_name . "
				WHERE
					id = ?
				LIMIT
					0,1";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
	 
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		$this->name = $row['name'];
		$this->image = $row['image'];
		$this->description = $row['description'];
		$this->type_id = $row['type_id'];
	}
	
	
	function update(){
 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name,
					image = :image,
					description = :description,
					type_id  = :type_id
				WHERE
					id = :id";
	 
		$stmt = $this->conn->prepare($query);
	 
		// posted values
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->type_id=htmlspecialchars(strip_tags($this->type_id));
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind parameters
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':image', $this->image);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':type_id', $this->type_id);
		$stmt->bindParam(':id', $this->id);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	
	// delete the post
	function delete(){
	 
		$query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
		 
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
	 
		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	
	
	// will upload image file to server
	function uploadPhoto(){
	 
		$result_message="";
	 
		// now, if image is not empty, try to upload the image
		if($this->image){
	 
			// sha1_file() function is used to make a unique file name
			$target_directory = "uploads/";
			$target_file = $target_directory . $this->image;
			$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
	 
			// error message is empty
			$file_upload_error_messages="";
			// make sure that file is a real image
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check!==false){
				// submitted file is an image
			}else{
				$file_upload_error_messages.="<div>Submitted file is not an image.</div>";
			}
			 
			// make sure certain file types are allowed
			$allowed_file_types=array("jpg", "jpeg", "png", "gif", "mov", "avi", "mpeg4");
			if(!in_array($file_type, $allowed_file_types)){
				$file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF, MOV, AVI, MPEG4  files are allowed.</div>";
			}
			 
			// make sure file does not exist
			if(file_exists($target_file)){
				$file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
			}
			 
			// make sure submitted file is not too large, can't be larger than 1 MB
			if($_FILES['image']['size'] > (1024000)){
				$file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
			}
			 
			// make sure the 'uploads' folder exists
			// if not, create it
			if(!is_dir($target_directory)){
				mkdir($target_directory, 0777, true);
			}
			
			// if $file_upload_error_messages is still empty
			if(empty($file_upload_error_messages)){
				// it means there are no errors, so try to upload the file
				if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
					// it means photo was uploaded
				}else{
					$result_message.="<div class='alert alert-danger'>";
						$result_message.="<div>Unable to upload photo.</div>";
						$result_message.="<div>Update the record to upload photo.</div>";
					$result_message.="</div>";
				}
			}
			 
			// if $file_upload_error_messages is NOT empty
			else{
				// it means there are some errors, so show them to user
				$result_message.="<div class='alert alert-danger'>";
					$result_message.="{$file_upload_error_messages}";
					$result_message.="<div>Update the record to upload photo.</div>";
				$result_message.="</div>";
			}
		}
	 
		return $result_message;
	}
	
	
}
?>