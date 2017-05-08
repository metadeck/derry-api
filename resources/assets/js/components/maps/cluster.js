Vue.component('map-cluster', {

    template: `
        <div class="map-container"></div>
    `,

    props: {
        locations: {
            type: Array,
            required: true
        }
    },

    mounted(){

        let bounds = new google.maps.LatLngBounds();

        let map = new google.maps.Map(this.$el, {
            zoom: 3,
            center: {lat: -28.024, lng: 140.887}
        });

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        let markers = this.locations.map(function(location, i) {
            let marker = new google.maps.Marker({
                position: location
            });

            var infowindow = new google.maps.InfoWindow({
                content: "<p>"+location.info+"</p>"
            });

            marker.addListener('click', function(){
                infowindow.open(map, marker);
            });

            bounds.extend(marker.position);

            return marker;
        });

        // Add a marker clusterer to manage the markers.
        let markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
    }
});
