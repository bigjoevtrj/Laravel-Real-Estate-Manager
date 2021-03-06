@extends('layouts.public')
@section('content')
    <div class="grid_8" id="left">
        <h3 class="panel-title">{{ $property->name }}</h3>
        <div class="item">
            @include('layouts.notifications')
            <div class="item-main-image half">
                <img src="{{ Property::primary_photo($property->id,array(291,210)) }}"/>
                <button type="submit" class="search-button button-yellow reserve" onclick="window.location = '{{ URL::to('clients/reserve/'.$property->id) }}'" style="width:48%;">Reserve Property</button>
                <button type="submit" class="search-button button-yellow reserve" onclick="window.location = '{{ URL::to('properties/calculator/'.$property->id) }}'" style="width:48%;">Calculator</button>
            </div>
            <div class="item-info half last">
                <table class="item-info-table">
                    <tr>
                        <td class="item-info-label">Price</td>
                        <td>&#8369;{{ number_format($property->price,2) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Reservation Fee</td>
                        <td>&#8369;{{ number_format($property->reservation_fee,2) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Equity</td>
                        <td>&#8369;{{ number_format($property->equity,2) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Location</td>
                        <td>{{ ucwords($property->location->name) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Beds</td>
                        <td>{{ $property->beds }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Baths</td>
                        <td>{{ $property->baths }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Lot Area</td>
                        <td>{{ $property->lot_area }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Floor Area</td>
                        <td>{{ $property->floor_area }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Developer</td>
                        <td>{{ ucwords($property->developer->name) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Type</td>
                        <td>{{ ucwords($property->type->name ) }}</td>
                    </tr>
                </table>
            </div> 
            <div class="clear"></div>
        </div>
        @if(!empty($gallery))
        <h3 class="panel-title">Images</h3>
        <ul class="item-images">
            @foreach($gallery as $photo)
            <?php $full = preg_replace('/(http:)(.*)(timthumb.php[?]src=)/','',$photo['fullsize']);?>
            <?php $full = preg_replace('/[&](.*)/', '', $full);?>
            <li><a class="fancybox" data-fancybox-group="gallery" href="{{ $full }}"><img src="{{ $photo['thumbnail'] }}" alt=""></a></li>
            @endforeach
        </ul>
        @endif
        <div style='clear:both;'></div><br>
        <h3 class="panel-title">Description</h3>
        <div class="item" style="min-height:300px;">
            {{ $property->description }}

        @if(is_object($property->monitorings) && $property->monitorings->count() > 0)
            <br><br>
            <h3 class="panel-title">Available Slots</h3>
            <table class="monitoring striped">
                <tr>
                    <td>Block</td>
                    <td>Lot</td>
                    <td>Status</td>
                </tr>
                @foreach($property->monitorings as $sex)
                <tr>
                    <td>{{ $sex->block }}</td>
                    <td>{{ $sex->lot }}</td>
                    <td>{{ $sex->status }}</td>
                </tr>
                @endforeach
            </table>
        @else
            <br><br>
            <div class="alert alert-info">No Available Blocks</div>
        @endif
        </div>
    </div>
@include('layouts.sidebar')    
@stop