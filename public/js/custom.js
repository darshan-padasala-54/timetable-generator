$(document).ready(function() {
    $(".number-only").keydown(function(event) {
        if (event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 9 && (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault();
        }
    });

    $('input#subjects_per_day, input#working_days').on('keyup', function() {
        let total_weekly_hours = 0;
        let subject_per_days = $('input#subjects_per_day').val();
        let working_days = $('input#working_days').val();
        if(working_days > 0 && subject_per_days > 0){
            total_weekly_hours = working_days*subject_per_days;
        }
        $('#total_hours_week').text(total_weekly_hours);
    });
});
