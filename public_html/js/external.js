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
    var notificationsPanel = document.getElementById("notificationsPanel");
    var notificationsContent = document.getElementById("notificationsContent");
    notificationsContent.innerHTML = n;
    notificationsPanel.className = "show";
    setTimeout(function() {
        notificationsPanel.className = notificationsPanel.className.replace("show", "");
    }, 3000);
}