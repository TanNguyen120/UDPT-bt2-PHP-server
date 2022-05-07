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
                    array.forEach((jsonObj) => {
                        const html = `<tr><th scope="row">${i}</th><td>${jsonObj.FullName}</td><td>.${jsonObj.ClubID}</td><td>${jsonObj.Nationality}</td><td>${jsonObj.Position}</td><td>${jsonObj.Number}</td> </tr>`;
                        $('#ajaxTableBody').append(html);
                        i++;
                    });
                }
            });
        });
    }

    function filterSearchWithManyCondition() {
        $(document).on('click', '#filterSearchBtn', function () {
            let name = $('#searchNameVal').val();
            if (name === '') {
                name = 'none';
            }
            let club = $('#clubSelect').val();
            if (club === '') {
                club = 'none';
            }
            let position = $('#positionSelect').val();
            if (position === '') {
                position = 'none';
            }
            let nationality = $('#nationSelect').val();
            if (nationality === '') {
                nationality = 'none';
            }
            let number = $('#customRange3').val();
            if (number === '0') {
                number = 'none';
            }
            $.ajax({
                url: 'Index.php?action=ajaxSearchFilter',
                type: 'GET',
                data: {
                    FullName: name,
                    ClubName: club,
                    Position: position,
                    Number: number,
                    Nationality: nationality
                }
            }).done((respond) => {
                alert(JSON.stringify(respond));
            });

        });
    }


    function showSliderNumber() {

        $('#customRange3').on('change', function () {
            const value = $(this).val();
            $('#numberOutPut').text(value);
        });
    }


    //*********************************************************************************************************************************** */
    // Phần Khai Báo Hàm
    findAllPlayerOfClub();
    findPlayerByNameSearchBar();
    searchAndFilter();
    showSliderNumber();
    filterSearchWithManyCondition();
});