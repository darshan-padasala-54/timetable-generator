$(document).ready(function() {
    $(".number-only").keydown(function(event) {
        if (event.keyCode != 190 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 9 && (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault();
        }
    });
});
