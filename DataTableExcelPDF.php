<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

</head>
<body>
<?php
$xml=simplexml_load_file("https://www.w3schools.com/xml/cd_catalog.xml") or die("Error: Cannot create object");
$json = json_encode($xml);
$array = json_decode($json,TRUE);

$books = $array["CD"];
?>
<table id="example">
    <thead>
    <tr>
        <th>TITLE</th>
        <th>ARTIST</th>
        <th>COUNTRY</th>
        <th>NORIMAS KIEKIS</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($array as $cd): ?>
        <?php foreach ($cd as $track): ?>
            <tr class="hover">
                <td contenteditable="true"><?php echo $track['TITLE']; ?></td>
                <td><?php echo $track['ARTIST']; ?></td>
                <td><?php echo $track['COUNTRY']; ?></td>
                <td contenteditable="true"></td>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>



<table id="examplecopy">
    <caption contenteditable="true">Įvesti skyriaus pavadinimą:</caption>
    <tr>
        <th>TITLE</th>
        <th>ARTIST</th>
        <th>COUNTRY</th>
        <th>NORIMAS KIEKIS</th>
    </tr>

</table>



<a href="javascript:demoFromHTML()">DOWNLOAD PDF</a>
<input type="button" onclick="tableToExcel('example', 'W3C Example Table')" value="Export to Excel">



<script>

    $(document).ready(function() {
        $('#example').DataTable({
            "scrollY":        "200px",
            "scrollCollapse": true,
            "paging":         false
        } );
    } );
</script>


<script>
    $('#example tr.hover').unbind('click').click(function(){
        $(this).clone().appendTo('#examplecopy').append("<button id='trynti' type=\"button\">Click Me!</button>");
        return false;
    });
</script>

<script>
    $(document).ready(function() {
        $('#examplecopy').DataTable();
    } );
</script>
<script>



    $("#examplecopy").on("click", "button", function() {
        $(this).closest("tr").remove();
    });



</script>
<script>

</script>
<script>

    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#examplecopy')[0];
        specialElementHandlers = {
            '#bypassme': function (element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                pdf.save('Test.pdf');
            }, margins);
    }
</script>
<script>
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table><caption>{table}</caption></table></body></html>'
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))

            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById("examplecopy")
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }
    })()

</script>