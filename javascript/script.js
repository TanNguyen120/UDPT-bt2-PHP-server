jQuery(document).ready(function ($) {
    "use strict";
    //*********************************************************************************************************************************** */
    // Phần định nghĩa hàm
    function findAllPlayerOfClub() {
        $('#results').on('click', '.clubResult', function () {
            const club = $(this).find("td:eq(0)").text();
            $.get('Index.php?action=list_player_from_club&page=1&club=' + club, function (data) {
                $('#results').html(data);
            });

            window.location = 'http://localhost/UDPT-bt2-PHP-server/Index.php?action=list_player_from_club&page=1&club=' + club;
        });
    }

    function findPlayerByNameSearchBar() {
        $(document).on('click', '#search-addon-searchPlayerName', function () {
            const name = $('#searchNameVal').val();
            window.location = 'http://localhost/UDPT-bt2-PHP-server/Index.php?action=searchPlayerName&page=1&playerName=' + name;
        });
    }


    //*********************************************************************************************************************************** */
    // Phần Khai Báo Hàm
    findAllPlayerOfClub();
    findPlayerByNameSearchBar();
});