jQuery(document).ready(function ($) {
    function updateInput() {
        $(Document).on('change', '#playerClubSelect', function () {
            const selectedClub = $(this).val();
            $('#formPlayerClub').val(selectedClub);
        });
        $(Document).on('change', '#playerNationSelect', function () {
            const selectedNation = $(this).val();
            $('#formInputPlayerNational').val(selectedNation);
        });
        $(Document).on('change', '#playerPositionSelect', function () {
            const selectedPosition = $(this).val();
            $('#formInputPlayerPosition').val(selectedPosition);
        });
    }

    updateInput();
})
