function initMap() {
    var element = document.getElementById('map');
    var address = element.dataset.address;
    var options = {
        zoom: 17,
        center: {lat:34.1012441, lng:-118.3458723}
    };

    var myMap = new google.maps.Map(element,options);

    var marker = addMarker({lat:34.1012441, lng:-118.3458723});

    var InfoWindow = new google.maps.InfoWindow({
        content: address
    });

    marker.addListener('click',function(){
        InfoWindow.open(myMap,marker);
    });

    function addMarker(coordinates){
        return new google.maps.Marker({
            position: coordinates,
            map: myMap,
            animation: google.maps.Animation.BOUNCE
        });
    }
}
