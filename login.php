<?php
require 'database2.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

// Get the posted data.
$postdata = file_get_contents("php://input");

