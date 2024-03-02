<script src="{{ URL::asset('js/map.js?v=2.9') }}"></script>
<?php $callback = isset($callback) ? $callback : 'initMap'?>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('custom.api.map') }}&libraries=places&callback={{ $callback }}" async defer></script>