<?php

class Post {

    //DB stuff
    private $conn;
    private $table = 'posts';

    // Posts Property
    private $id;
    private $category_id;
    private $category_name;
    private $title;
    private $body;
    private $author;
    private $created_at;

    // CONSTRUCTOR with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //GET Posts
    public function read() {

        //Create Query
        $query = 'SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM 
                    '. $this->table .' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC';


        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;

    }
}

?>