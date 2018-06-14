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

$postData = filter_input(INPUT_POST, 'order_cod', FILTER_DEFAULT);

$update = new \CRUD\Update;
$update->update('order_service', ['order_sync' => 1], "WHERE order_cod = :cod", "cod={$postData}");

$orderService = (!empty($update->getResult()) ? $update->getResult() : null);

if (empty($orderService)) {
    $error->setError('Não foi possível marcar como sincronizado!', 'Houve um erro e não foi possível marcar o registro como sincronizado');
    echo json_encode($error->getError(), JSON_PRETTY_PRINT);
} else {
    echo json_encode($orderService, JSON_PRETTY_PRINT);
    exit;
}