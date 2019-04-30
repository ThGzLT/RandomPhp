<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/lt-normal') }}" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.2/xlsx.core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.2/xlsx.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>




    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.1.1/dist/jspdf.plugin.autotable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.54/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.54/vfs_fonts.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/1.9.0/exceljs.min.js"></script>




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<?php use Illuminate\Support\Facades\Auth; ?>

<div class="row"; style="height: 100px"></div>

<table id="examplecopy10" class="table table-striped">
    <thead>
    <tr>

    <tr>
        <th>PRODUKTO KODAS</th>
        <th>PRODUKTAS</th>
        <th>MATAS</th>
        <th>KIEKIS</th>
        <th>APRAŠYMAS</th>
        <th>KOREGUOTI</th>

    </tr>


    </thead>
    <tbody>
    <?php
    $skaiciususer = isset(Auth::user()->id) ? Auth::user()->id : Auth::user()->email;
?>
    @foreach ($kopijos as $recor)
          @if($recor->tag == $skaiciususer)
        <tr>
            <td>    {{  $recor->produkto_kodas }} </td>
            <td>    {{  $recor->produktas }} </td>
            <td>    {{  $recor->matas }} </td>
            <td>    {{  $recor->kiekis }} </td>
            <td contenteditable="true">    {{  $recor->aprasymas }} </td>

            <td><a href="{{ route('nukreipymas2',$recor->id)}}" class="btn btn-primary">Pridėti aprašymą</a></td>
            <td>
                <form action="{{ route('nukreipymasdelete', $recor->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Ištrynti</button>
                </form>
            </td>
        </tr>
@endif
    @endforeach


    </tbody>
</table>


<script>

    $(function() {

        var headers = $("th",$("#examplecopy10")).map(function() {
            return this.innerHTML;
        }).get();

        var rows = $("tbody tr",$("#examplecopy10")).map(function() {
            return [$("td",this).map(function() {
                return this.innerHTML;
            }).get()];
        }).get();

        console.log(rows);
      //  alert(rows);
    });





</script>


<script>

  /*  $("#vienas").on("click", "button", function() {


        $(this).closest("tr").clone().appendTo('#examplecopy1').append("<td class=\"SecTable\" contenteditable=\"true\"></td>")
            .append("<td><button class=\"btn\"><i class=\"fa fa-remove\" style=\"font-size:18px;color:red\"></i></button></td>").find('td.SecondTable').remove();
    });
*/
</script>

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
