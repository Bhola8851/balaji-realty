//function ban();
//{
//document.getElementById("banner").value="Close Curtain";
//}


$(document).ready(function(){

    
    var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 19.0760, lng: 72.8777},
          zoom: 8
        });

    var marker = new google.maps.Marker({
        position: {
            lat: 19.0760,
            lng: 72.8777
        },
        map : map,
        
    });
        
    //var showMap = document.getElementById('searchMap').value;

    var searchBox = new google.maps.places.SearchBox(document.getElementById('searchMap'));
    //var searchBox = new google.maps.places.SearchBox(showMap);

    //console.log(searchBox);
    
    //console.log(showMap);
    //var searchBox = new google.maps.places.SearchBox('India');
    //show(searchBox);
    
    document.getElementById('searchMap').onclick = function () {
        
        var input = document.getElementById('searchMap');

        google.maps.event.trigger(input, 'focus', {});
        google.maps.event.trigger(input, 'keydown', { keyCode: 13 });
        google.maps.event.trigger(this, 'focus', {});
    }

    
        google.maps.event.addListener(searchBox,'places_changed',function(){
            console.log(searchBox);
            var places = searchBox.getPlaces();
            console.log(searchBox);

            var bounds = new google.maps.LatLngBounds();
            var i,place;
    
            for(i=0; place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location); //set marker position new
            }
    
            map.fitBounds(bounds);
            map.setZoom(15);
        });

    

    
      
});