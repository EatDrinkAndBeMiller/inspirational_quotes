<?php

require('config/Database.php');
require('models/Quote.php');
require('models/Author.php');
require('models/Category.php');

$database = new Database();
$db = $database->connect();

//Instantiate each model
$quote = new Quote($db);
$author = new Author($db);
$category = new Category($db);

//get parameters
$authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
$categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
    if ($authorId) { $quote->authorId = $authorId; }
    if ($categoryId) { $quote->categoryId = $categoryId; }

// Read Data
$authors = $author->read();
$categories = $category->read();
$quotes = $quote->read();
include('view/list_quotes.php');

