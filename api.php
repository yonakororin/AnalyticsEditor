<?php
// api.php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

require_once __DIR__ . '/classes/Logger.php';
require_once __DIR__ . '/classes/DatabaseExecutor.php';
require_once __DIR__ . '/classes/ApiController.php';

$controller = new ApiController();
$controller->handleRequest();
