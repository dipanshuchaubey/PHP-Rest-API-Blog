<?php

//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acess-Control-Allow-Methods: DELETE');
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

$post->id = $data->id;

// Create Post
if($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}