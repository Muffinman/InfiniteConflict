@section('title', 'Planets')

@extends('layouts/html')

@section('content')

    <div class="planet-list">
        @foreach($planets as $planet)
            <div class="planet">
                <div class="planet-image"><a href="{{ url('planets/' . $planet->id) }}"><img src="/images/planets/{{ $planet->type }}.jpg" alt="{{ $planet->name }}"></a></div>

                <div class="planet-static-resources">
                    <h2>
                        {{ $planet->name }}
                        <a href="{{ url('nav/' . $planet->coords()) }}">(<img src="/images/coords.gif" alt="{{ $planet->coords() }}" /> {{ $planet->coords() }})</a>
                    </h2>
                    <ul>
                        @foreach($planet->staticResources as $resource)
                            <li class="resource">
                                <img src="/images/resources/{{ $resource->id }}.gif" alt="{{ $resource->name }}" />
                                {{ number_format($resource->pivot->stored) }}
                                @if ($resource->requires_storage)
                                    ({{ number_format($resource->pivot->storage) }} storage)
                                @endif
                                @if ($resource->pivot->busy)
                                    ({{ number_format($resource->pivot->busy) }} busy)
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="planet-production-resources">
                    <ul>
                    @foreach($planet->productionResources as $resource)
                        <li class="resource resource-{{ str_slug($resource->name) }}">
                            <img src="/images/resources/{{ $resource->id }}.gif" alt="{{ $resource->name }}" />
                            {{ number_format($resource->pivot->stored) }}
                            ({{ $planet->outputFormatted($resource->id) }})
                            {{ $resource->pivot->abundance }}%
                        </li>
                    @endforeach
                    </ul>
                </div>

                <div class="planet-production">
                    <ul>
                        <li>
                            <a href="/planets/{{ $planet->id }}">Building:</a>
                            @if ($planet->buildingQueue->count())
                                {{ $planet->buildingQueue->first()->name }} ({{ $planet->buildingQueue->first()->pivot->turns }} turns)
                            @else
                                None
                            @endif
                        </li>
                        <li>
                            <a href="/planets/{{ $planet->id }}/production">Production:</a>
                            @if ($planet->unitQueue->count())
                                {{ $planet->unitQueue->first()->pivot->qty }} {{ $planet->unitQueue->first()->name }} ({{ $planet->unitQueue->first()->pivot->turns }} turns)
                            @else
                                None
                            @endif
                        </li>
                        <li>
                            <a href="/planets/{{ $planet->id }}/training">Training:</a>
                            @if ($planet->conversionQueue->count())
                                {{ $planet->conversionQueue->first()->pivot->qty }} {{ $planet->conversionQueue->first()->name }} ({{ $planet->conversionQueue->first()->pivot->turns }} turns)
                            @else
                                None
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

@endsection