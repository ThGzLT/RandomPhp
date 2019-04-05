<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DataTableTestas</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>





    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<?php
$xml=simplexml_load_file("https://www.w3schools.com/xml/cd_catalog.xml") or die("Error: Cannot create object");
$json = json_encode($xml);
$array = json_decode($json,TRUE);

$books = $array["CD"];
?>
<script>

    $(document).ready(function() {
        var table = $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columnDefs: [{
                orderable: false,
                targets: [1,2,3],
            }]
        });

        $('button').click( function() {
            var data = table.$('input, select').serialize();
            alert(
                "The following data would have been submitted to the server: \n\n"+
                data.substr( 0, 120 )+'...'
            );
            return false;
        } );
    } );

</script>


<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>TITLE</th>
        <th>ARTIST</th>
        <th>COUNTRY</th>
        <th>FILLER</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($array as $cd): ?>
    <?php foreach ($cd as $track): ?>
        <tr>
            <td><?php echo $track['TITLE']; ?></td>
            <td><?php echo $track['ARTIST']; ?></td>
            <td><?php echo $track['COUNTRY']; ?></td>
            <td><input type="text" id="row-1-age" name="row-1-age" value=""></td>
        </tr>
    <?php endforeach; ?>
<?php endforeach; ?>
    </tbody>
</table>
