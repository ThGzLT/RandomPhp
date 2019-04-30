@extends('layouts.app')

@section('content')
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 300px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
    <?php

    $xml = simplexml_load_file("http://vaistukai.kul.lt/phpServices/getLikuciaiXML.php") or die("Error: Cannot create object");
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);

    ?>


    <a href="{{ URL::to('/customers/pdf') }}">Export PDF</a>
    <a href="{{ route('export') }}">XLSX</a>
    <a href="{{ route('export_pdf') }}">I PDF</a>

    <a href="{{ route('generate-pdf',['download'=>'pdf']) }}">Download PDF</a>

    <input id="myInput" type="text" placeholder="PAIEŠKA..">
    <div class="table-wrapper-scroll-y my-custom-scrollbar">


        <table id="vienas" class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>Produkto kodas</th>
            <th>Produktas</th>
            <th>Matas</th>
            <th>Kiekis</th>
        </tr>

        </thead>
        <tbody id="myTable">
@foreach ($records as $record)
    <tr>
<td>    {{  $record->id }} </td>
<td>    {{  $record->produkto_kodas }} </td>
<td>    {{  $record->produktas }} </td>
<td>    {{  $record->matas }} </td>
<td>    {{  $record->kiekis }} </td>
        <td><a href="{{ route('nukreipymas',$record->id)}}" class="btn btn-primary">Pridėti</a></td>

        </td>
    </tr>

@endforeach
</tbody>
    </table>
    </div>

<div class="row"; style="height: 100px"></div>



    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>

        $("#examplecopy").on("click", "button", function() {
            $(this).closest("tr").remove();
        });
    </script>


    @include('prasitestavimas')
    @include('LenteleSpausdinimui')
@endsection



{{--

<table id="examplecopy" class="table table-striped">
    <thead>
    <tr>

    <tr>
        <th>id</th>
        <th>Produkto kodas</th>
        <th>Produktas</th>
        <th>Matas</th>
        <th>Kiekis</th>
        <th>Aprasymas</th>
    </tr>


    </thead>
    <tbody>
    @foreach ($kopijos as $recor)
        <tr>
            <td>    {{  $recor->id }} </td>
            <td>    {{  $recor->produkto_kodas }} </td>
            <td>    {{  $recor->produktas }} </td>
            <td>    {{  $recor->matas }} </td>
            <td>    {{  $recor->kiekis }} </td>
            <td>    {{  $recor->aprasymas }} </td>
        </tr>

    @endforeach


    </tbody>
</table>
--}}

