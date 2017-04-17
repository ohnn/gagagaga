function changeViews(toBeHidden, toBeShown) {
    $(toBeHidden).animate({
        opacity: 0
    }, 600, function() {
        $(this).hide();
        $(toBeShown).show();
        $(toBeShown).animate({
            opacity: 1
        });
    });
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
}

// clear url on refresh
if (performance.navigation.type == 1) {
    var host = window.location.hostname;
    var path = window.location.pathname;
    var protocol = window.location.protocol;
    window.location = protocol + "//" + host + path;
}


$(document).ready(function() {

    $('.registerButton').click(function() {
        changeViews($('.form-signin'), $('.form-signup'));
    });

    $('.backToLogin').click(function() {
        changeViews($('.form-signup'), $('.form-signin'));
    });


    $('#role').change(function() {
        switch ($('#role').val()) {
            case "2":
                changeViews($('.add_admin'), $('.add_doctor'));
                resetForm($('.add_admin'));
                break;
            case "3":
                changeViews($('.add_doctor'), $('.add_admin'));
                resetForm($('.add_doctor'));
                break;
            default:
                $('.add_admin').hide();
                $('.add_doctor').hide();
                resetForm($('.add_admin'));
                resetForm($('.add_doctor'));
                break;
        }
    });

    $('#userAdd, .userAdd').click(function() {
        var form = $(this).parent();
        var username = form.find('#inputName1').val();
        var pw1 = form.find('#registerPassword').val();
        var pw2 = form.find('#registerPassword1').val();
        if (/[^a-zA-Z0-9]/.test(username)) {
            alert('Ainoastaan kirjaimet A-Z ja numerot 0-9 ovat sallittuja.');
            return;
        }
        if (username.length < 4 || username.length > 18) {
            alert('Käyttäjänimen tulee olla vähintään 4 merkkiä ja korkeintaan 18 merkkiä pitkä');
            return;
        }
        if (pw1 == pw2 && pw1.length >= 4) {
            form.submit();
        }
        else {
            alert('Salasanat eivät täsmää tai salasana ei ole tarpeeksi pitkä (salasanan tulee olla vähintään neljä merkkiä pitkä).');
            return;
        }
    });
    
    $('.reserveTimeElement').css('opacity', '1');
    
    $('.doctor-AddTimesContainer').css('opacity', '1');
    
});

// mistä mihin
function addData(element, element2) {
    var value = $(element).attr('data-id');
    console.log(value);
    $(element2).attr('value', value);
}


