<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 11/06/2018
 * Time: 14:26
 */

namespace Model;

use CRUD\Create;
use CRUD\Read;
use CRUD\Update;

class OrderService
{

    private $cod;
    private $client;
    private $address;
    private $problem;
    private $date;
    private $status;
    private $employee;

    private $create;
    private $read;
    private $update;
    private $error;

    public function __construct()
    {
        $this->create = new Create;
        $this->read = new Read;
        $this->update = new Update;
        $this->error = new Error;
    }

    public function getError()
    {
        return $this->error->getError();
    }

    public function createOrderService($client, $address, $problem, $date, $status = 1, $employee)
    {
        $this->client = $client;
        $this->address = $address;
        $this->problem = $problem;
        $this->date = $date;

        if (strtolower($status) == 'aberto') {
            $this->status = 1;
        } else {
            $this->status = 2;
        }

        $this->employee = $employee;

        $orderServiceData = [
            'order_client' => $this->client,
            'order_address' => $this->address,
            'order_problem' => $this->problem,
            'order_date' => $this->date,
            'order_status' => $this->status,
            'order_employee' => $this->employee,
        ];

        try {
            $this->create->create('order_service', $orderServiceData);
            return $this->create->getResult();
        } catch (\PDOException $e) {
            $this->error->setError('Não foi possível cadastrar a Ordem de Serviço', $e->getMessage());
            return false;
        }

    }

    public function generateCodOrderService($orderId)
    {
        do {
            $this->cod = date('Ym') . microtime(true);
            $this->read->read('order_service', "WHERE order_cod = :cod", "cod={$this->cod}");

            if (!$this->read->getResult()) {
                $this->update->update('order_service', ['order_cod' => $this->cod], "WHERE order_id = :order", "order={$orderId}");
                break;
            }

        } while (1 == 1);

        return $this->cod;
    }
}