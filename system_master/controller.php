<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 11/06/2018
 * Time: 13:20
 */

$postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postData = array_map('strip_tags', $postData);
$postData = array_map('trim', $postData);

$action = $postData['action'];
unset($postData['action']);

require_once __DIR__ . '/config.php';

switch ($action) {
    case 'add_os':

        $orderService = new \Model\OrderService;

        $order = $orderService->createOrderService(
            $postData['client'],
            $postData['address'],
            $postData['problem'],
            $postData['date'],
            $postData['status'],
            $postData['employee']
        );

        if ($order === false) {
            $json['error'] = $orderService->getError();
            break;
        } else {
            $order = $orderService->generateCodOrderService($order);
            $json['order_cod'] = $order;
            $json['success'] = true;
        }

        break;
}

echo json_encode($json);