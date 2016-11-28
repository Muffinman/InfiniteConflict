@section('title', 'Create your empire!')

@extends('layouts/html')

@section('content')

    <div>
        <h2>Time to create your empire...</h2>

        @include('validation')

        <form action="" method="post">
            {{ csrf_field() }}
            <p>
                <label>Ruler Name</label>
                <input type="text" name="ruler_name" value="@if ($data['ruler_name']){{ $data['ruler_name'] }}@endif" />
            </p>
            <p>
                <label>Home Planet Name</label>
                <input type="text" name="home_planet_name" value="@if ($data['home_planet_name']){{ $data['home_planet_name'] }}@endif" />
            </p>
            <p>
                <input type="submit" value="Save" />
            </p>
        </form>
    </div>

@endsection