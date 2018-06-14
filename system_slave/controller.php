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
    case 'sync_os':

        $orderService = new \Model\OrderService;
        $orders = $orderService->getOrderServiceServer();

        if(empty($orders) || !empty($orders->title)){
            $json['error'] = true;
            $json['error_message'] = $orders->title;
        } else {
            foreach ($orders as $order) {
                $orderService->createOrderService($order->order_cod, $order->order_client, $order->order_address, $order->order_problem, $order->order_date, $order->order_status, $order->order_employee);
                $orderService->setOrderServiceSyncTrue($order->order_cod);
            }

            $json['success'] = true;
        }

        break;

    case 'sync_note':

        $read = new \CRUD\Read;
        $read->read('order_service_notes', "WHERE note_order_sync IS NULL");

        if($read->getResult()){

            $orderService = new \Model\OrderService;

            foreach($read->getResult() as $item){

                $sync = $orderService->sendNoteOrderService($item->note_order_service, $item->note_order_text, $item->note_order_date);

                if ($sync == true){
                    $orderService->setNoteSyncOrderService($item->note_order_service);
                }
            }

            $json['success'] = true;
        } else {
            $json['error'] = true;
            $json['error_message'] = 'Não há registros para sincronizar!';
        }

        break;

    case 'send_note':

        $orderService = new \Model\OrderService;
        $orderService->addNoteOrderService($postData['order_cod'], $postData['text']);

        $json['success'] = true;

        break;
}

echo json_encode($json);