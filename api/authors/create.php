<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->author)) {    
        //assign data to author model
        $author->author = $data->author;

        $author->create();
        
        echo json_encode(
            array('message' => 'Author Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Created. Missing Required Parameters')
        );
    }
