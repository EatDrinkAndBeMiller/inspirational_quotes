<?php
class Category {
    //DB connection
    private $conn;
    private $table = 'categories';

    //quote properties
    public $id;
    public $category;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    //get all categories
    public function read() {
        //create query
        $query = 'SELECT id, category
                    FROM ' . $this->table . ' 
                    ORDER BY id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    //read a single category & id
    public function read_single() {
        $query = 'SELECT id, category
                    FROM ' . $this->table . ' 
                    WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id', $this->id);

        //excuted query
        $stmt->execute();
            //GET the array 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties
        $this->id = $row['id'];
        $this->category = $row['category'];
    }

    //Create category
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' SET 
                    category = :category';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->category = htmlspecialchars(strip_tags($this->category));

        //bind data
        $stmt->bindParam(':category', $this->category);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //udpate a category
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . ' SET 
                    category = :category
                WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete category
    public function delete() {
        //Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

}