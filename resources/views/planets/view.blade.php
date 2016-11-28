@section('title', 'Planets')
@section('queue_title', 'Building Queue')

@extends('layouts/html')


@section('content')

    <div class="planet-view">
        
        @include('planets/header')

        <div class="planet-completed-list">
            <h2 class="box-title">Completed Structures</h2>
            <div class="box-content">
                <ul class="completed-list">
                    @foreach($planet->buildings as $building)
                        <li>
                            <img class="built" src="/images/buildings/{{ $building->id }}.jpg" alt="{{ $building->name }}" />
                            <div class="name">{{ $building->pivot->qty }} {{ $building->name }} <a href="#">[x]</a></div>
                            <div class="resources">
                                @foreach($building->resources as $resource)
                                    @if ($resource->pivot->output)
                                        <span class="resource resource-{{ str_slug($resource->name) }}"><img class="resource" src="/images/resources/{{ $resource->id }}.gif" alt="{{ $resource->name }}" />
                                        {{ $building->outputFormatted($planet->id, $resource->id) }}</span>
                                    @endif
                                    @if ($resource->pivot->cost && !$resource->production_resource && !$resource->pivot->refund_on_completion)
                                        <span class="resource resource-{{ str_slug($resource->name) }}"><img class="resource" src="/images/resources/{{ $resource->id }}.gif" alt="{{ $resource->name }}" />
                                        {{ $resource->pivot->cost }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="planet-content">
            <div class="building-queue">
                <h2 class="box-title">Building Queue</h2>
                <div class="box-content">
                    @if ($planet->buildingQueue->count() > 0)
                        <table class="striped">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Name</th>
                                    <th>Turns</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planet->buildingQueue as $building)
                                    <tr>
                                        <td>{{ $building->pivot->rank }}</td>
                                        <td><img src="/images/buildings/{{ $building->id }}.jpg" alt="{{ $building->name }}" /> {{ $building->name }}</td>
                                        <td>{{ $building->pivot->turns }}</td>
                                        <td>{{ $building->pivot->started ? 'Started' : 'Queued' }}</td>
                                        <td><a href="#">[x]</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>You currently have nothing in the queue.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{ $planet->availableBuildings }}

@endsection

