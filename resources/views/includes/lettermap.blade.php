@if(!empty($places))
  @section('lettermap')
    <leaflet-geojson
    :path='"/maps/letter/{{ $data['id'] }}"'
    />
  @endsection
@endif
