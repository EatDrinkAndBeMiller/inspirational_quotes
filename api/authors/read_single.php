<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../config/Database.php';
require '../../models/Author.php';

//Instantiate DB & connect to it
$database = new Database();
$db = $database->connect();

$author = new Author($db);

//parameter data
$id = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
$author->id = $id;
    if(empty($id)) {
        echo json_encode(
            array('message' => 'Missing required parameter')
        );
        return false;
    }

$author->read_single();

$author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

//Turn to JSON & output
echo json_encode($author_arr);
