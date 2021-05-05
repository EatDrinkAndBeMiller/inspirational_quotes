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
    $authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
    $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
        if ($authorId) { $quote->authorId = $authorId; }
        if ($categoryId) { $quote->categoryId = $categoryId; }
        if ($limit) { $quote->limit = $limit; }

    //call read method
    $result = $quote->read();
    $num = $result->rowCount();

    //check if any quotes
    if($num > 0) {
        //quote array
        $quotes_arr=array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author' => $author,
                'category' => $category
            );

            //push to "data" in $quotes_arr
            array_push($quotes_arr, $quote_item);
        }

        //Turn to JSON & output
        echo json_encode($quotes_arr);

    } else {
        //no quotes
        echo json_encode(
            array('message' => 'No quotes Found')
        );
    }