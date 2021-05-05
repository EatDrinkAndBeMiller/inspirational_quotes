<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->quote) && !empty($data->authorId) && !empty($data->categoryId) && !empty($data->id)) {
    //set id to be updated
        $quote->id = $data->id;

        //assign data to quote model
        $quote->quote = $data->quote;
        $quote->authorId = $data->authorId;
        $quote->categoryId = $data->categoryId;

        //update quote
        $quote->update();
            
        echo json_encode(
            array('message' => 'Quote Updated')
            );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Updated. Missing Required Parameters.')
        );
    }