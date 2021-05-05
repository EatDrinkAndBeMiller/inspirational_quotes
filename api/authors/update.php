<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->author) && !empty($data->id)) {
    //set id to be updated
        $author->id = $data->id;
        $author->author = $data->author;
       
        $author->update();
            
        echo json_encode(
            array('message' => 'Author Updated')
            );
    } else {
        echo json_encode(
            array('message' => 'Author Not Updated. Missing Required Parameters.')
        );
    }