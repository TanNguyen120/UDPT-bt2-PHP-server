jQuery(document).ready(function ($) {
    "use strict";
    function findAllPlayerOfClub() {
        $('#results').on('click', '.clubResult', function () {
            const club = $(this).find("td:eq(0)").text();
            $.get('Index.php?action=list_player_from_club&page=1&club=' + club, function (data) {
                $('#results').html(data);
            });

            window.location = 'http://localhost/UDPT-bt2-PHP-server/Index.php?action=list_player_from_club&page=1&club=' + club;
        });
    }
    findAllPlayerOfClub();
});