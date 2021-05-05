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

    $result = $category->read();
    $num = $result->rowCount();

    //check if any categories
    if($num > 0) {
        //category array
        $categories_arr=array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category
            );

            //push to "data" in $categories_arr
            array_push($categories_arr, $category_item);
        }

        //Turn to JSON & output
        echo json_encode($categories_arr);

    } else {
        //no categories
        echo json_encode(
            array('message' => 'No Categories Found')
        );
    }