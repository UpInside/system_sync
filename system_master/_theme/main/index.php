<?php

if ($url[0] != 'index') {

    $read = new \CRUD\Read;
    $read->read('order_service', "WHERE order_id = :order", "order={$url[0]}");

    if ($read->getResult()) {
        $order_id = $read->getResult()[0]->order_id;
        $order_cod = $read->getResult()[0]->order_cod;
        $order_client = $read->getResult()[0]->order_client;
        $order_address = $read->getResult()[0]->order_address;
        $order_problem = $read->getResult()[0]->order_problem;
        $order_date = date('d/m/Y H:i', strtotime($read->getResult()[0]->order_date));
        $order_status = $read->getResult()[0]->order_status;
        $order_employee = $read->getResult()[0]->order_employee;
        $add = false;
    }

}
?>

<div class="container">

    <div class="main_panel content radius">
        <h2>:: Criar nova Ordem De Serviço</h2>

        <div class="j_content_message"></div>

        <form method="post" class="form_os">
            <input type="hidden" name="order_id" value="<?= !empty($order_id) ? $order_id : ''; ?>">

            <div class="form_os_row">
                Código:
                <input name="cod" value="<?= !empty($order_cod) ? $order_cod : ''; ?>" type="text" class="radius" disabled="disabled" readonly="readonly" style="background: #FBFBFB; cursor: no-drop">
            </div>
            <div class="form_os_row">
                Cliente:
                <input name="client" value="<?= !empty($order_client) ? $order_client : ''; ?>" type="text" class="radius">
            </div>
            <div class="form_os_row">
                Endereço:
                <input name="address" value="<?= !empty($order_address) ? $order_address : ''; ?>" type="text" class="radius">
            </div>
            <div class="form_os_row">
                Problema:
                <input name="problem" value="<?= !empty($order_problem) ? $order_problem : ''; ?>" type="text" class="radius">
            </div>
            <div class="form_os_row" class="radius">
                Data:
                <input name="date" value="<?= !empty($order_date) ? $order_date : ''; ?>" type="datetime-local" class="radius">
            </div>
            <div class="form_os_row">
                Status:
                <select name="status" class="radius">
                    <option value="aberto" <?= (!empty($order_status) && $order_status == 1 ? 'selected=selected' : null); ?>>Aberto</option>
                    <option value="fechado" <?= (!empty($order_status) && $order_status == 2 ? 'selected=selected' : null); ?>>Fechado</option>
                </select>
            </div>
            <div class="form_os_row">
                Técnico:
                <input name="employee" value="<?= !empty($order_employee) ? $order_employee : ''; ?>" type="text" class="radius">
            </div>
            <?php
            if (empty($add) || $add == false) {
                echo "<div class='form_os_row_reverse'>
                        <button type='submit' class='radius add_os'>Cadastrar OS</button>
                    </div>";
            }
            ?>
        </form>
    </div>

    <div class="main_panel content radius">
        <h2>:: Gerenciar Notas</h2>

        <section class="main_panel_notes_list">

            <?php

            $read = new \CRUD\Read;
            $read->read('order_service_notes', "WHERE note_order_service = :os", "os=" . (!empty($order_cod) ? $order_cod : ""));
            if (!$read->getResult()) {
                echo "<article class='radius'>
                            <p style='text-align: center;'>Nenhuma nota para exibir!</p>
                      </article>";
            } else {
                foreach ($read->getResult() as $item) {
                    echo "<article class='radius'>
                                <p class='date'>" . date('d/m/Y H:i\h', strtotime($item->note_order_date)) . "</p>
                                <p>{$item->note_order_text}</p>
                          </article>";
                }
            }
            ?>
        </section>
    </div>
</div>