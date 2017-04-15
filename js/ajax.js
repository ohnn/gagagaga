
// seuraava kuukausi kalenterissa
function calendarRight(el) {
    var nextMonth = $(el).attr('data-date');
    console.log('clickevent toimii');
    $.ajax({
      type: 'POST',
      url: 'test.php',
      data: {'month': nextMonth},
      success: function(data){
        console.log('xd');
        $('#calendarTable').replaceWith(data);
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
      data: {'month': lastMonth},
      success: function(data){
        console.log('xd');
        $('#calendarTable').replaceWith(data);
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
       data: {'date': date},
       success: function(data){
           console.log('xd');
           $('.roleContainer').append(data);
           changeViews('#calendarTable', '.availabletimesContainer');
           $('.takaisin').click(function(){
                changeViews('.availabletimesContainer', '#calendarTable');
                setTimeout(function(){
                    $('.availabletimesContainer').remove();
                }, 1000);
           });
       }
    });
}