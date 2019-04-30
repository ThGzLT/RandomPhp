@extends('layouts.admin')
@section('content')
    <?php header("Location: http://localhost/projektai/Atsargos/public/index.php/Vartotojas");
    die();
    ?>
    <div class=”row”>
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading btn-primary">ADMINSTRATORIAUS VALDYMO SKYDELIS</div>
            <div class="panel-body"><a href="{{ route('Vartotojas.create') }}">SUKURTI VARTOTOJĄ</a></div>
            <div class="panel-body">    <a href="{{ route('Vartotojas.index') }}">VARTOTOJŲ SĄRAŠAS IR REDAGAVIMAS</a></div>
            <div class="panel-body"><a href="{{ route('Skyriai.create') }}">SUKURTI SKYRIŲ</a></div>
            <div class="panel-body">    <a href="{{ route('Skyriai.index') }}">SKYRIŲ SĄRAŠAS IR REDAGAVIMAS</a></div>
            <div class="panel-body"><a href="{{ route('VartotojasSkyrius.create') }}">SUKURTI SĄSAJA TARP VARTOTOJO IR SKYRIAUS</a></div>
            <div class="panel-body">    <a href="{{ route('VartotojasSkyrius.index') }}">SĄSAJŲ TARP VARTOTOJO IR SKYRIAUS SĄRAŠAS IR REDAGAVIMAS</a></div>

        </div>
    </div>
    </div>
@endsection