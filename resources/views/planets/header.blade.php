<div class="planet-header">

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

    <div class="planet-image"><a href="{{ url('planets/' . $planet->id) }}"><img src="/images/planets/{{ $planet->type }}.jpg" alt="{{ $planet->name }}"></a></div>

    <div class="planet-production-resources">
        <table class="collapsed">
            <thead>
                <th></th>
                @foreach($planet->productionResources as $resource)
                    <th class="name">
                        <img src="/images/resources/{{ $resource->id }}.gif" alt="{{ $resource->name }}" />
                        {{ $resource->name }}
                    </th>
                @endforeach
            </thead>
            <tbody>
                @foreach(['stored', 'output', 'abundance'] as $col)
                    <tr>
                        <td>{{ ucwords($col) }}</td>
                        @foreach($planet->productionResources as $resource)
                            @if ($col == 'stored')
                                <td class="resource resource-{{ str_slug($resource->name) }} stored">
                                    {{ number_format($resource->pivot->stored) }}
                                </td>
                            @endif
                            @if ($col == 'output')
                                <td class="resource resource-{{ str_slug($resource->name) }} output">
                                    {{ $planet->outputFormatted($resource->id) }}
                                </td>
                            @endif
                            @if ($col == 'abundance')
                                <td class="resource resource-{{ str_slug($resource->name) }} abundance">
                                    {{ $resource->pivot->abundance }}%
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <ul class="planet-menu">
        <li>
            <a href="/planets/{{ $planet->id }}">Building</a>
        </li>
        <li>
            <a href="/planets/{{ $planet->id }}/production">Production</a>
        </li>
        <li>
            <a href="/planets/{{ $planet->id }}/training">Training</a>
        </li>
        <li>
            <a href="/planets/{{ $planet->id }}/comms">Comms</a>
        </li>
    </ul>
</div>