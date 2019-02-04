<?php

class Post {

    //DB stuff
    private $conn;
    private $table = 'posts';

    // Posts Property
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

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

    //GET Single Posts
    public function read_single() {
    
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
                WHERE 
                    p.id = ?
                LIMIT 0,1';


        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //SER Properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id']; 
        $this->category_name = $row['category_name'];

    }
}

?>