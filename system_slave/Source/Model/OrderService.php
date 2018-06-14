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

    /*
     * Attr REST
     */
    private $url;
    private $endPoint;
    private $email;
    private $token;
    private $preset;
    private $params;
    private $callback;

    /*
     * Object OrderService
     */
    private $cod;
    private $client;
    private $address;
    private $problem;
    private $date;
    private $status;
    private $employee;

    /*
     * Object Notes
     */
    private $noteText;

    /*
     * Composition Objects
     */
    private $create;
    private $read;
    private $update;
    private $error;

    public function __construct()
    {
        /*
         * Composition
         */
        $this->create = new Create;
        $this->read = new Read;
        $this->update = new Update;
        $this->error = new Error;

        /*
         * Autenticate API REST
         */
        $this->url = 'https://localhost/play/play_system_sync/system_master/_api';
        $this->email = 'robson@upinside.com.br';
        $this->token = '321';

        /*
         * Preset API
         */
        $this->preset = [
            'email' => $this->email,
            'token' => $this->token
        ];
    }

    public function getError()
    {
        return $this->error->getError();
    }

    public function createOrderService($cod, $client, $address, $problem, $date, $status = 1, $employee)
    {
        $this->cod = $cod;
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
            'order_cod' => $this->cod,
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

    public function addNoteOrderService($cod, $note)
    {
        $this->cod = $cod;
        $this->noteText = $note;

        $noteAdd = [
            'note_order_service' => $this->cod,
            'note_order_text' => $this->noteText,
            'note_order_date' => date('Y-m-d H:i:s')
        ];

        try {
            $this->create->create('order_service_notes', $noteAdd);
            return $this->create->getResult();
        } catch (\PDOException $e) {
            $this->error->setError('Não foi possível cadastrar nota na Ordem de Serviço', $e->getMessage());
            return false;
        }
    }

    public function setNoteSyncOrderService($cod)
    {
        $this->update->update('order_service_notes', ['note_order_sync' => 1], "WHERE note_order_service = :cod", "cod={$cod}");
        return true;
    }

    /********************************
     **** METHOD SYNC TO MASTER *****
     *******************************/

    public function getOrderServiceServer()
    {
        $this->endPoint = '/orderServiceGetAll.php';
        $this->get();
        return $this->callback;
    }

    public function setOrderServiceSyncTrue($cod)
    {
        $this->endPoint = '/orderServiceSyncTrue.php';

        $this->params = [
            'order_cod' => $cod
        ];

        $this->post();

        return $this->callback;
    }

    public function sendNoteOrderService($cod, $note, $date)
    {
        $this->endPoint = '/orderServiceAddNote.php';

        $this->params = [
            'note_order_service' => $cod,
            'note_order_text' => $note,
            'note_order_date' => $date
        ];

        $this->post();

        return $this->callback;
    }

    /********************************
     ******** METHOD REST ***********
     *******************************/

    private function post()
    {
        $url = $this->url . $this->endPoint . '?' . http_build_query($this->preset);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, []);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }

    private function get()
    {
        $url = $this->url . $this->endPoint . '?' . http_build_query($this->preset);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }
}