<template>

    <v-btn @click="geolocalitzacio" class="btn btn-default" id="askButton">Ask for location</v-btn>
</template>

<script>
var target = document.getElementById('target')
var watchId
var map, infoWindow;
export default {
  name: 'Geolocation',
  data () {
    return {
      value: ''
    }
  },
  methods: {
    geolocalitzacio () {
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
          'Error: The Geolocation service failed.' :
          'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
      // function appendLocation (location, verb) {
      //   verb = verb || 'updated'
      //   var newLocation = document.createElement('p')
      //   newLocation.innerHTML = 'Location ' + verb + ': <a href="https://maps.google.com/maps?&z=15&q=' + location.coords.latitude + '+' + location.coords.longitude + '&ll=' + location.coords.latitude + '+' + location.coords.longitude + '" target="_blank">' + location.coords.latitude + ', ' + location.coords.longitude + '</a>'
      //   target.appendChild(newLocation)
      // }
      //
      // if ('geolocation' in navigator) {
      //   document.getElementById('askButton').addEventListener('click', function () {
      //     navigator.geolocation.getCurrentPosition(function (location) {
      //       appendLocation(location, 'fetched')
      //     })
      //     watchId = navigator.geolocation.watchPosition(appendLocation)
      //   })
      // } else {
      //   target.innerText = 'Geolocation API not supported.'
      // }
    }
  }
}
</script>

<style scoped>

</style>
