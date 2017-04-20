// seuraava kuukausi kalenterissa
function calendarRight(el) {
    var nextMonth = $(el).attr('data-date');
    console.log('clickevent toimii');
    $.ajax({
        type: 'POST',
        url: 'test.php',
        data: {
            'month': nextMonth
        },
        success: function(data) {
            console.log('xd');
            $('.varaaAika').remove();
            $('#calendarTable').replaceWith(data);
            $('.reserveTimeElement').css('opacity', '1');
            $('.tooltip').remove();
        }
    });
}

// kuukausi taaksepäin kalenterissa
function calendarLeft(el) {
    var lastMonth = $(el).attr('data-date');
    console.log('clickevent toimii');
    $.ajax({
        type: 'POST',
        url: 'test.php',
        data: {
            'month': lastMonth
        },
        success: function(data) {
            console.log('xd');
            $('.varaaAika').remove();
            $('#calendarTable').replaceWith(data);
            $('.reserveTimeElement').css('opacity', '1');
            $('.tooltip').remove();
        }
    });
}

// näytä ajat kalenterista valitulle päivälle
function getTimes(calendarDate) {
    var date = $(calendarDate).attr('value');
    console.log('getTimes toimii');
    $.ajax({
        type: 'POST',
        url: 'availabletimes.php',
        data: {
            'date': date
        },
        success: function(data) {
            console.log('xd');
            $('.alert').remove();
            $('.roleContainer').append(data);
            changeViews('#calendarTable', '.availabletimesContainer');
            $('.takaisin').click(function() {
                changeViews('.availabletimesContainer', '#calendarTable');
                setTimeout(function() {
                    $('.availabletimesContainer').remove();
                }, 1000);
            });
        }
    });
}

// korvaa ensimmäinen toisella, kolmas parametri = lisättävän elementin url
function loadAndChange(toBeReplaced, toReplace, getUrl) {
    console.log('loadAndChange toimii (ajax.js)');
    console.log(toBeReplaced, toReplace, getUrl);
    console.log($(toReplace).length);
    if ($(toReplace).length) {
        console.log('ehto toimii');
        return;
    }
    $.get(getUrl, function(data) {
        $('.roleContainer').append(data);
        changeViews(toBeReplaced, toReplace);
        setTimeout(function() {
            $(toBeReplaced).remove();
        }, 1000);
        console.log('get onnistui');
    });
}


/**
 * NOT WORKING
 * 
 *   $('#removeReservation').on('click', function(){
 *       console.log('removeReservation.click toimii');
 *       var value = $(this).attr('data-id');
 *       $.post('jeccu/freeTime.php', {freeTimeID: value});
 *   });
 * 
 */

function removeReservation(element) {
    console.log('function removeReservation toimii!');
    var value = $(element).attr('value');
    $.post('jeccu/freeTime.php', {
        freeTimeID: value
    }, function() {
        console.log('removeReservation toimii!');
        $('#' + value).remove();
        $('.alert').remove();
        $.get('includes/removeReservationSuccess.php', function(data) {
            $('header').after(data);
            $(data).fadeIn();
        });
    });
}

$( document ).ajaxComplete(function() {
    $(".sortTable").tablesorter();
});