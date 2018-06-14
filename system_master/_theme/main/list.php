<div class="container">

    <div class="main_panel content radius">
        <h2>:: Listagem de Ordens de Serviço</h2>
        <table class="radius">
            <tr>
                <td>Cód</td>
                <td>Cliente</td>
                <td>Data</td>
                <td>Status</td>
            </tr>
            <tr>
                <td colspan="4">
                    <div style="height: 1px; width: 100%; border: 1px solid #EBEBEB; margin-bottom: 10px;"></div>
                </td>
            </tr>

            <?php
            $read = new \CRUD\Read;
            $read->read('order_service', 'ORDER BY order_date DESC');

            if (!$read->getResult()) {
                echo "<tr><td colspan='4' align='center'>Nenhum registro para exibir</td></tr>";
            } else {

                foreach ($read->getResult() as $item) {

                    $item->order_status = ($item->order_status == 1 ? 'Aberto' : 'Fechado');

                    echo "<tr>
                        <td><a href='https://localhost/play/play_system_sync/system_master/{$item->order_id}'>{$item->order_cod}</a></td>
                        <td>{$item->order_client}</td>
                        <td>" . date('d/m/Y H:s', strtotime($item->order_date)) . "</td>
                        <td>{$item->order_status}</td>
                    </tr>";
                }
            }
            ?>
        </table>
    </div>

</div>