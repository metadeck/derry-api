Vue.component('map-location-selector', {

    template: `
        <div class="map-container"></div>
    `,

    props: {
        latitude: {
            type: Number,
            default: 55.01657628017477
        },
        longitude: {
            type: Number,
            default: -7.309233337402361
        }
    },

    mounted(){
        // Set coordinates
        let myLatlng = new google.maps.LatLng(this.latitude, this.longitude);

        // Options
        let mapOptions = {
            zoom: 12,
            center: myLatlng
        };

        // Apply options
        let map = new google.maps.Map(this.$el, mapOptions);

        // Add marker
        let marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Hello World!'
        });

        marker.setMap(map);

        let self = this;

        google.maps.event.addListener(map, "center_changed", function() {
            let lat = map.getCenter().lat();
            let lon = map.getCenter().lng();
            let newLatLng = {lat: lat, lng: lon};
            marker.setPosition(newLatLng);

            self.$emit('locationUpdated', newLatLng)
        });
    }
});
