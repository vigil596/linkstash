<?php

require __DIR__ . '/../src/Storage.php';
require __DIR__ . '/../src/Controller/HomeController.php';
require __DIR__ . '/../src/Controller/BookmarkController.php';

use App\Storage;
use App\Controller\HomeController;
use App\Controller\BookmarkController;

$storage = new Storage(__DIR__ . '/../data/bookmarks.json');
$home = new HomeController();
$bookmarks = new BookmarkController($storage);

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

header('Content-Type: application/json');

if ($path === '/' && $method === 'GET') {
    echo $home->index();
} elseif ($path === '/bookmarks' && $method === 'GET') {
    echo $bookmarks->list();
} elseif ($path === '/bookmarks' && $method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
    http_response_code(201);
    echo $bookmarks->create($input);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}
