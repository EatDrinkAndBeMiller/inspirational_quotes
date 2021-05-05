<?php
class Author {
    //DB connection
    private $conn;
    private $table = 'authors';

    //quote properties
    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    //get all authors
    public function read() {
        //create query
        $query = 'SELECT id, author
                    FROM ' . $this->table . ' 
                    ORDER BY id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    //read a single author & id
    public function read_single() {
        $query = 'SELECT id, author
                    FROM ' . $this->table . ' WHERE id = :id';

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
        $this->author = $row['author'];
    }

    //Create author
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' SET 
                    author = :author';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->author = htmlspecialchars(strip_tags($this->author));

        //bind data
        $stmt->bindParam(':author', $this->author);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //udpate an author
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . ' SET 
                    author = :author
                WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete author
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