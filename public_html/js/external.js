(function smoothScrollToSections() {
    $(".scroll-btn").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 500, function () {
                window.location.hash = hash;
            });
        }
    });
})();

function showGoogleMaps() {
    if (typeof google === 'object' && typeof google.maps === 'object') {
        var myLatLng = {lat: 52.160161, lng: 21.022213};
        var map = new google.maps.Map(document.getElementById('googlemapscontainer'), {
            zoom: 11,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Piotr Wróblewski'
        });
    } else {
        console.log('Uuups coś poszło nie tak ...');
    }
};

(function setSubmitMessageForm() {
    var request;
    $("#submitMessageForm").submit(function(event) {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: "SendMail",
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            showNotification(response);
            $('input[type="text"],input[type="email"],textarea').val('');
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+textStatus, errorThrown
            );
        });
        request.always(function () {
            $inputs.prop("disabled", false);
        });
    });
})();

function showNotification(n) {
    let notificationsPanel = document.getElementById("notificationsPanel");
    let notificationsContent = document.getElementById("notificationsContent");
    notificationsContent.innerHTML = n;
    notificationsPanel.className = "show";
    setTimeout(function() {
        notificationsPanel.className = notificationsPanel.className.replace("show", "");
    }, 3000);
}


var countDownToNumer = (function(e) {
    var executed = false;
     return function(e) {
        if (!executed) {
            executed = true;
            var counter = 0;
            //console.log(e);
            var interval0 = setInterval(function() {
                counter++; 
                e[0].el.innerHTML = counter;
                if (counter >= e[0].c) clearInterval(interval0);
            }, parseInt(5000/e[0].c));
            var interval1 = setInterval(function() {
                counter++; 
                e[1].el.innerHTML = counter;
                if (counter >= e[1].c) clearInterval(interval1);
            }, parseInt(5000/e[1].c));
            var interval2 = setInterval(function() {
                counter++; 
                e[2].el.innerHTML = counter;
                if (counter >= e[2].c) clearInterval(interval2);
            }, parseInt(5000/e[2].c));
            var interval3 = setInterval(function() {
                counter++; 
                e[3].el.innerHTML = counter;
                if (counter >= e[3].c) clearInterval(interval3);
            }, parseInt(5000/e[3].c));
        }
    };
})();

var el = document.getElementById("numbers");

window.onscroll = function() {
    if ( document.body.scrollTop > (el.offsetTop - el.offsetHeight - 300) || document.documentElement.scrollTop > (el.offsetTop - el.offsetHeight - 300)) {
        countDownToNumer(
            [{el: document.getElementById('num-cli'), c: 7},
            {el: document.getElementById('num-pro'), c: 31},
            {el: document.getElementById('num-cof'), c: 125},
            {el: document.getElementById('num-col'), c: 256}]
        );      
    }
};