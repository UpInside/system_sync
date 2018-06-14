$(function () {

    $('html').on('submit', 'form[name="sync_os"]', function (e) {
        e.preventDefault();

        $(this).ajaxSubmit({
            url: 'controller.php',
            data: {action: 'sync_os'},
            type: 'POST',
            dataType: 'json',
            success: function (data) {

                if (data.success) {
                    $('.j_content_message_sync').empty();
                    $('.j_content_message_sync').append("<div class='message success radius'>" +
                        "<p>Sincronismo feito com sucesso!</p>" +
                        "</div>");
                }

                if (data.error) {
                    $('.j_content_message_sync').empty();
                    $('.j_content_message_sync').append("<div class='message error radius'>" +
                        "<p>" + data.error_message + "</p>" +
                        "</div>");
                }

            }
        });

        return false;
    });

    $('html').on('submit', 'form[name="sync_note"]', function (e) {
        e.preventDefault();

        $(this).ajaxSubmit({
            url: 'controller.php',
            data: {action: 'sync_note'},
            type: 'POST',
            dataType: 'json',
            success: function (data) {

                if (data.success) {
                    $('.j_content_message_sync').empty();
                    $('.j_content_message_sync').append("<div class='message success radius'>" +
                        "<p>Sincronismo feito com sucesso!</p>" +
                        "</div>");
                }

                if (data.error) {
                    $('.j_content_message_sync').empty();
                    $('.j_content_message_sync').append("<div class='message error radius'>" +
                        "<p>" + data.error_message + "</p>" +
                        "</div>");
                }

            }
        });

        return false;
    });

    $('html').on('submit', 'form[name="send_note"]', function (e) {
        e.preventDefault();

        $(this).ajaxSubmit({
            url: 'controller.php',
            data: {action: 'send_note'},
            type: 'POST',
            dataType: 'json',
            success: function (data) {

                if (data.success) {
                    location.reload();
                }

            }
        });

        return false;
    });

});