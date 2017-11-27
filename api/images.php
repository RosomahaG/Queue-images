<?php

include '../loader.php';

header('Content-Type: application/json');

$data = [];
$id = isset($_GET['id']) ? intval($mysqli->real_escape_string($_GET['id'])) : false;
$title = isset($_GET['title']) ? $mysqli->real_escape_string($_GET['title']) : false;
$description = isset($_GET['description']) ? $mysqli->real_escape_string($_GET['description']) : false;

switch ($_GET['action']) {
    case 'delete':
        $data = $id ? image_delete($id) : null;
        break;
    case 'update':
        $data = $id ? image_update($id, $title, $description) : null;
        break;
    case 'read':
        $data = image_list();
        break;
    default:
        $data = 'Bad request!';
}

echo json_encode($data);
