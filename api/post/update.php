<?php

//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acess-Control-Allow-Methods: PUT');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers, Content-Type, Acess-Control-Allow-Methods, Athorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

//Get data
$data = json_decode(file_get_contents("php://input"));

$post->id          = $data->id;
$post->title       = $data->title;
$post->body        = $data->body;
$post->author      = $data->author;
$post->category_id = $data->category_id;

// Create Post
if($post->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}