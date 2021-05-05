<?php
class Quote {
    //DB connection
    private $conn;
    //table for the model
    private $table = 'quotes';

    //quote properties
    public $id;
    public $quote;
    public $authorId;
    public $categoryId;
    public $limit;
    public $single_quote;

    public function __construct($db) {
        $this->conn = $db;
    }
    
/*     Each of my model files have the following methods: read(), read_single(), create(), update(), and delete()
 */
    //get quotes to read
    public function read() {
        //create query
        $query = 'SELECT q.id, q.quote, a.author, c.category
                    FROM ' . $this->table . ' q 
                    LEFT JOIN authors a ON q.authorId = a.id
                    LEFT JOIN categories c ON q.categoryId = c.id';

         if ($this->limit) { 
            $query = $query . " LIMIT ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $this->limit, PDO::PARAM_INT);
        
        } else if ($this->authorId && $this->categoryId){
            $query = $query . " WHERE q.authorId = :authorId 
                                AND q.categoryId = :categoryId";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);
        
        } else if ($this->authorId) {
            $query = $query . " WHERE q.authorId = :authorId";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':authorId', $this->authorId);
        
        } else if ($this->categoryId) {
            $query = $query . " WHERE q.categoryId = :categoryId";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':categoryId', $this->categoryId);
        
        } else {
            $stmt = $this->conn->prepare($query);
        }
    
        $stmt->execute();

        return $stmt;
    }

    //read a single quote
    public function read_single() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
                    FROM ' . $this->table . ' q 
                    LEFT JOIN authors a ON q.authorId = a.id
                    LEFT JOIN categories c ON q.categoryId = c.id
                    WHERE q.id = :id';

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
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];
    }

    //Create quote
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' SET 
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        //bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //udpate a quote
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . ' SET 
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId
                WHERE id = :id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data (because data what people submitting)
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete Post
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