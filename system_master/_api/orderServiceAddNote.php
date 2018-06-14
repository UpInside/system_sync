<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 11/06/2018
 * Time: 18:49
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';

$error = new \Model\Error;
$api = new \Model\Api;

$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
$token = filter_input(INPUT_GET, 'token', FILTER_DEFAULT);

$apiComm = $api->authentication($email, $token);

if ($apiComm == false) {
    echo json_encode($api->getError(), JSON_PRETTY_PRINT);
    exit;
}

$postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$addNote = [
    'note_order_service' => $postData['note_order_service'],
    'note_order_text' => $postData['note_order_text'],
    'note_order_date' => $postData['note_order_date']
];

$create = new \CRUD\Create;
$create->create('order_service_notes', $addNote);

if (empty($create->getResult())) {
    $error->setError('Não foi possível marcar como sincronizado!', 'Houve um erro e não foi possível marcar o registro como sincronizado');
    echo json_encode($error->getError(), JSON_PRETTY_PRINT);
} else {
    echo json_encode(['success' => true], JSON_PRETTY_PRINT);
    exit;
}