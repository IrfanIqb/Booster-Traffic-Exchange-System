$(document).ready(function () {

    var should_run = false;

    $("#source").click(function () {
        $('#status').html("Running");
        should_run = true;
    });

    $("#pause").click(function () {
        $('#status').html("Stopped");
        location.reload();
        should_run = false;
    });

    setInterval(function () {
        if (should_run) {
            getSession();
            $current = 0;
            $width = 40;
            set_interval = setInterval(function () {
                if (should_run) {
                    clearInterval(progress_interval);
                    progress();
                }
            }, 900);
            clearInterval(set_interval);
        }
    }, 15000);


    progress_interval = setInterval(function () {
        if (should_run) {
            progress();
        }
    }, 1300);


    function getSession() {
        $.ajax({
            'type': 'GET',
            'url': '/api/session',

            'success': function (value) {
                win = window.open(value.website, );
                if (!win || win.closed || typeof win.closed == 'undefined') {
                    alert('Allow POPUPS From Browser Settings ');
                }
                else {

                    $.ajax({
                        'type': 'GET',
                        'url': '/api/increment?client_id=' + value.client_id
                    });
                    setTimeout(function () {
                        win.self.close();
                    }, 8000)
                }
            }
        });
    }

    $current = 0;
    $width = 40;

    function progress() {
        $('#progress').attr('aria-valuenow', $current);
        $('#progress').css('width', $width);
        $('#progress').html($current + " % ");
        $current = $current + 10;
        $width = $width + 3;


    }


});