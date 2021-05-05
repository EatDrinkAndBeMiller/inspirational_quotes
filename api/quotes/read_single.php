<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../config/Database.php';
require '../../models/Quote.php';

//Instantiate DB & connect to it
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$quote = new Quote($db);

//parameter data
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$quote->id = $id;
    if(empty($id)) {
        echo json_encode(
            array('message' => 'Missing required parameter')
        );
        return false;
    }

//call read method
$quote->read_single();

$quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category
    );

//Turn to JSON & output
echo json_encode($quote_arr);
