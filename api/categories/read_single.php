<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../../config/Database.php';
require '../../models/Category.php';

//Instantiate DB & connect to it
$database = new Database();
$db = $database->connect();

$category = new Category($db);

//parameter data
$id = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
$category->id = $id;
    if(empty($id)) {
        echo json_encode(
            array('message' => 'Missing required parameter')
        );
        return false;
    }

//call read method
$category->read_single();

$category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

//Turn to JSON & output
echo json_encode($category_arr);
