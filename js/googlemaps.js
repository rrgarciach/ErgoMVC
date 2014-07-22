function initialize() {
    google.maps.visualRefresh = true;
//  var myLatlng = new google.maps.LatLng(28.662613, -106.102889);
    var myLatlng = new google.maps.LatLng(clienteX, clienteY);
    var mapOptions = {
        zoom: 15,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Hello World!'
    });
//    var c = map.getCenter();
//    alert(c.lat());
}

//google.maps.event.addDomListener(window, 'load', initialize);