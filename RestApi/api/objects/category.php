<?php
class Category{
 
    // database connection and table name
    private $conn;
    private $table_name = "categories";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $created;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, name, description
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
    // used by select drop-down list
public function read(){
 
    //select all data
    $query = "SELECT
                id, name, description
            FROM
                " . $this->table_name . "
            ORDER BY
                name";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
               id=:id, name=:name, description=:description, created=:created, modified=:modified,";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
     $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->created=htmlspecialchars(strip_tags($this->created));
    $this->modified=htmlspecialchars(strip_tags($this->modified));
    
   
    
 
    // bind values
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":created", $this->created);
    $stmt->bindParam(":modified", $this->modified);
    
   
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}
?>

