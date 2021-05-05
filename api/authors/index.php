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

    //call read method
    $result = $author->read();
    $num = $result->rowCount();

    //check if any authors
    if($num > 0) {
        //author array
        $authors_arr=array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            //push to "data" in $authors_arr
            array_push($authors_arr, $author_item);
        }

        //Turn to JSON & output
        echo json_encode($authors_arr);

    } else {
        //no authors
        echo json_encode(
            array('message' => 'No authors Found')
        );
    }