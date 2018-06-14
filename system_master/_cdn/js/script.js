$(function () {

    $('html').on('submit', 'form', function (e) {
        e.preventDefault();

        $(this).ajaxSubmit({
            url: 'controller.php',
            data: {action: 'add_os'},
            type: 'POST',
            dataType: 'json',
            success: function (data) {

                if (data.success) {
                    $('.j_content_message').empty();
                    $('.j_content_message').append("<div class='message success radius'>" +
                        "<p>A ordem de serviço foi inclusa com sucesso!</p>" +
                        "</div>");
                }

                if (data.error) {
                    $('.j_content_message').empty();
                    $('.j_content_message').append("<div class='message error radius'>" +
                        "<p>Não foi possível inserir a ordem de serviço!</p>" +
                        "<p>" + data.error_message + "</p>" +
                        "</div>");
                }

                if (data.order_cod) {
                    $('input[name="cod"]').val(data.order_cod);
                }

            }
        });

        return false;
    });
});