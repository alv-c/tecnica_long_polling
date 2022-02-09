<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>

    $(function() {
        pegaNotificacoes();
    })

    function pegaNotificacoes(timestamp) {
        var data = Array()

        if (typeof $timestamp != 'undefined') {
            data.timestamp = timestamp
        }

        $.post('longPolling.php', data, function(res) {

            for (let i in res.notificacoes) {

                $('#resultados').append(res.notificacoes[i].notificacao + '<br>')

            }

            pegaNotificacoes(res.timestamp)

        }, 'json')

    }

</script>

<div id="resultados">

</div>