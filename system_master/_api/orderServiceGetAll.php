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

if ($apiComm == false){
    echo json_encode($api->getError(), JSON_PRETTY_PRINT);
    exit;
}

$read = new \CRUD\Read;
$read->read('order_service', "WHERE order_employee = :user AND order_date >= CURRENT_TIMESTAMP AND order_sync IS NULL", "user={$apiComm}");

$orderService = (!empty($read->getResult()) ? $read->getResult() : null);

if(empty($orderService)){
    $error->setError('Não há registros para exibir!', 'Até o momento não há Ordens de Serviço, volte mais tarde.');
    echo json_encode($error->getError(), JSON_PRETTY_PRINT);
} else {
    echo json_encode($orderService, JSON_PRETTY_PRINT);
    exit;
}