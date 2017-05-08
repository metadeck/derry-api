Vue.component('map-simple-single-marker', {

    template: `
        <div class="map-container"></div>
    `,

    props: {
        latitude: {
            type: Number,
            required: true
        },
        longitude: {
            type: Number,
            required: true
        },
        title: {
            type: String,
            required: true
        }
    },

    mounted(){
        // Set coordinates
        let myLatlng = new google.maps.LatLng(this.latitude, this.longitude);

        // Options
        let mapOptions = {
            zoom: 10,
            center: myLatlng
        };

        // Apply options
        let map = new google.maps.Map(this.$el, mapOptions);
        let contentString = this.title;

        // Add info window
        let infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        // Add marker
        let marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Hello World!'
        });

        // Attach click event
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }
});
