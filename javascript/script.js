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

    function searchAndFilter() {
        $(document).on('click', '#search-addon-searchPlayerNameAjax', function () {
            const name = $('#searchNameVal').val();
            $.ajax({
                url: 'Index.php?action=ajaxSearchName&page=1&playerName=' + name,
                type: 'GET',
                success: function (respond) {
                    let i = 1;
                    const array = JSON.parse(respond);
                    alert(JSON.stringify(array));
                    array.forEach((jsonObj) => {
                        const html = `<tr><th scope="row">${i}</th><td>${jsonObj.FullName}</td><td>.${jsonObj.ClubID}</td><td>${jsonObj.Nationality}</td><td>${jsonObj.Position}</td><td>${jsonObj.Number}</td> </tr>`;
                        $('#ajaxTableBody').append(html);
                        i++;
                    });
                }
            });
        });
    }


    //*********************************************************************************************************************************** */
    // Phần Khai Báo Hàm
    findAllPlayerOfClub();
    findPlayerByNameSearchBar();
    searchAndFilter();
});