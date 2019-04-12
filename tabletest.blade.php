


   <?php
    /*
DB_HOST=sql7.freemysqlhosting.net
DB_PORT=3306
DB_DATABASE=sql7287457
DB_USERNAME=sql7287457
DB_PASSWORD=t5UDnYu5HX

     */

    ?>


    <?php
    use App\Http\Middleware\Authenticate;

    ?>
    <?php
    $xml = simplexml_load_file("http://vaistukai.kul.lt/phpServices/getLikuciaiXML.php") or die("Error: Cannot create object");
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);
    ?>



    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Produkto kodas</th>
            <th scope="col">Produktas</th>
            <th scope="col">Matas</th>
            <th scope="col">Kiekis</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($array as $alt)
            @foreach($alt as $track)
                <tr class="hover">

                    <td class="tikr">{{$track['produkto_kodas']}}  </td>
                    <td>{{$track['produktas']}}</td>
                    <td>{{$track['matas']}}</td>
                    <td class="SecondTable">{{$track['kiekis']}}</td>
                    <td class="SecondTable">    <button id="Prideti"><i class="fa fa-plus" style="font-size:24px;color:green;padding-top: 3px";></i></button></td>

                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    <div><h1></h1></div>
    <div id="Perskyra">
        <h2>Pasirinktos prekės</h2>
    </div>
    <input type="button" onclick="PDF()" value="PDF">

    <!-- <input type="button" onclick="PDF()" value="PDF">  pdf exportas-->
    <input type="button" onclick="tableToExcel('example', 'W3C Example Table')" value="XLSX">
    <div id="vienas">
        <table id="examplecopy" class="table">
            <thead>
            <tr>
                <th id="textOne" hidden>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</th>
                <th id="textTwo" hidden></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>

            </tr>
            <tr hidden></tr>

            <tr>

                <th>Produkto kodas</th>
                <th>Produktas</th>
                <th>Matas</th>
                <th>Kiekis</th>
                <th></th>
            </tr>
            </thead>
            <tbody>



            </tbody>
        </table>
    </div>



    <table id="secret" hidden>
        <thead>
        <tr>
            <th scope="col">Produkto kodas</th>
            <th scope="col">Produktas</th>
            <th scope="col">Matas</th>
            <th scope="col">Kiekis</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($array as $alt)
            @foreach($alt as $track)
                <tr class="hover">

                    <td class="tikr">{{$track['produkto_kodas']}}  </td>
                    <td>{{$track['produktas']}}</td>
                    <td>{{$track['matas']}}</td>
                    <td class="SecondTable">{{$track['kiekis']}}</td>
                    <td class="SecondTable">    <button id="Prideti"><i class="fa fa-plus" style="font-size:24px;color:green;padding-top: 3px";></i></button></td>

                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>



    <script>
        $(document).ready(function() {

            $('#myselection').on('change', function () {


                $(this).closest('form').submit();
                $("#textTwo").empty();

                $("#myselection option:selected").clone().appendTo('#textTwo');
            })

        });

    </script>

    <script>




        $("#example").on("click", "button", function() {



            var myArra = $("#examplecopy").find('tr').map(function(){
                return [ $("th", this).text(), $("td.tikr", this).map(function(){ return $(this).text();}).get() ];
            }).get();
            var myArr = $("#example").find('tr').map(function(){
                return [ $("th", this).text(), $("td.tikr", this).map(function(){ return $(this).text();}).get() ];
            }).get();


            console.log(myArra);

            $(this).closest("tr").clone().appendTo('#examplecopy').append("<td class=\"SecTable\" contenteditable=\"true\"></td>")
                .append("<td><button class=\"btn\"style=\"\n" +
                    "    margin-top: -2px;\"><i class=\"fa fa-remove\" style=\"font-size:18px;color:red\"></i></button></td>").find('td.SecondTable').remove();
// ieskojimas eiluciu
            $.each(myArra, function(i, el){
                if($.inArray(el, myArra) === -1) myArra.push(el);
            });
            var allCells = $('#examplecopy tr td.tikr');

            var textMapping = {};
            allCells.each(function() {
                textMapping[$(this).text()] = true;
            });

            var count = 0;
            for (var text in textMapping)
                count++;
            // alert(allCells.text());
            if (count !== allCells.length) {
                alert("Pasikartojanti reikšmė");
                $('#examplecopy tr:last').remove();
            }



        });

    </script>


    <script>
        $(document).ready(function() {
            $('#myselection').on('change', function () {
                if ("#textTwo:not(:empty)") {
                    $(this).closest("#textTwo").find("#vartotojoskyrius").remove();
                }
            });
        });
    </script>

    <script>

        $("#examplecopy").on("click", "button", function() {
            $(this).closest("tr").remove();
        });
    </script>

    <script>
        function demoFromHTML() {

            /*
                        const doc = new jsPDF();

                        $("#textOne").attr("hidden", false);
                        $("#textTwo").attr("hidden", false);
                        doc.autoTable({html: '#examplecopy'});

                        doc.save('table.pdf');
                        $("#textOne").attr("hidden", true);
                        $("#textTwo").attr("hidden", true)
                        */

        }
    </script>
    <script>
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,',
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->' +
                    '</head><body><table><caption>{table}</caption></table></body></html>'
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




    <script>
        /* uzclickinant ant tr nukopijuoja i kita lentele
        $('#example tr.hover ').unbind('click').click(function(){
            $(this).clone().appendTo('#examplecopy').append("<td class=\"SecTable\" contenteditable=\"true\"></td>")
                .append("<td><button class=\"btn\"><i class=\"fa fa-remove\" style=\"font-size:18px;color:red\"></i></button></td>").find('td.SecondTable').remove();
            return false;
        });

         */
    </script>



    <script>
        var docDefinition = {
            content: [
                {
                    table: {
                        // headers are automatically repeated if the table spans over multiple pages
                        // you can declare how many rows should be treated as headers
                        headerRows: 1,
                        widths: [ '*', 'auto', 100, '*' ],

                        body: [
                            [ 'First', 'Second', 'Third', 'The last one' ],
                            [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
                            [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
                        ]
                    }
                }
            ]
        };
    </script>

    <script>



        function PDF() {

            pdfForElement('examplecopy').download();

        }
        function pdfForElement(id) {
            function ParseContainer(cnt, e, p, styles) {
                var elements = [];
                var children = e.childNodes;
                if (children.length != 0) {
                    for (var i = 0; i < children.length; i++) p = ParseElement(elements, children[i], p, styles);
                }
                if (elements.length != 0) {
                    for (var i = 0; i < elements.length; i++) cnt.push(elements[i]);
                }
                return p;
            }

            function ComputeStyle(o, styles) {
                for (var i = 0; i < styles.length; i++) {
                    var st = styles[i].trim().toLowerCase().split(":");
                    if (st.length == 2) {
                        switch (st[0]) {
                            case "font-size":
                            {
                                o.fontSize = parseInt(st[1]);
                                break;
                            }
                            case "text-align":
                            {
                                switch (st[1]) {
                                    case "right":
                                        o.alignment = 'right';
                                        break;
                                    case "center":
                                        o.alignment = 'center';
                                        break;
                                }
                                break;
                            }
                            case "font-weight":
                            {
                                switch (st[1]) {
                                    case "bold":
                                        o.bold = true;
                                        break;
                                }
                                break;
                            }
                            case "text-decoration":
                            {
                                switch (st[1]) {
                                    case "underline":
                                        o.decoration = "underline";
                                        break;
                                }
                                break;
                            }
                            case "font-style":
                            {
                                switch (st[1]) {
                                    case "italic":
                                        o.italics = true;
                                        break;
                                }
                                break;
                            }
                        }
                    }
                }
            }

            function ParseElement(cnt, e, p, styles) {
                if (!styles) styles = [];
                if (e.getAttribute) {
                    var nodeStyle = e.getAttribute("style");
                    if (nodeStyle) {
                        var ns = nodeStyle.split(";");
                        for (var k = 0; k < ns.length; k++) styles.push(ns[k]);
                    }
                }

                switch (e.nodeName.toLowerCase()) {
                    case "#text":
                    {
                        var t = {
                            text: e.textContent.replace(/\n/g, "")
                        };
                        if (styles) ComputeStyle(t, styles);
                        p.text.push(t);
                        break;
                    }
                    case "b":
                    case "strong":
                    {
                        //styles.push("font-weight:bold");
                        ParseContainer(cnt, e, p, styles.concat(["font-weight:bold"]));
                        break;
                    }
                    case "u":
                    {
                        //styles.push("text-decoration:underline");
                        ParseContainer(cnt, e, p, styles.concat(["text-decoration:underline"]));
                        break;
                    }
                    case "i":
                    {
                        //styles.push("font-style:italic");
                        ParseContainer(cnt, e, p, styles.concat(["font-style:italic"]));
                        //styles.pop();
                        break;
                        //cnt.push({ text: e.innerText, bold: false });
                    }
                    case "span":
                    {
                        ParseContainer(cnt, e, p, styles);
                        break;
                    }
                    case "br":
                    {
                        p = CreateParagraph();
                        cnt.push(p);
                        break;
                    }
                    case "table":
                    {
                        var t = {

                            table: {
                                widths: [],
                                body: []
                            }
                        }
                        var border = e.getAttribute("border");
                        var isBorder = false;
                        if (border)
                            if (parseInt(border) == 1) isBorder = true;
                        if (!isBorder) t.layout = 'noBorders';
                        ParseContainer(t.table.body, e, p, styles);

                        var widths = e.getAttribute("widths");
                        if (!widths) {
                            if (t.table.body.length != 0) {
                                if (t.table.body[0].length != 0)
                                    for (var k = 0; k < t.table.body[0].length; k++) t.table.widths.push("*");
                            }
                        } else {
                            var w = widths.split(",");
                            for (var k = 0; k < w.length; k++) t.table.widths.push(w[k]);
                        }
                        cnt.push(t);
                        break;
                    }
                    case "tbody":
                    {
                        ParseContainer(cnt, e, p, styles);
                        //p = CreateParagraph();
                        break;
                    }
                    case "tr":
                    {
                        var row = [];
                        ParseContainer(row, e, p, styles);
                        cnt.push(row);
                        break;
                    }
                    case "td":
                    {
                        p = CreateParagraph();
                        var st = {
                            stack: []
                        }
                        st.stack.push(p);

                        var rspan = e.getAttribute("rowspan");
                        if (rspan) st.rowSpan = parseInt(rspan);
                        var cspan = e.getAttribute("colspan");
                        if (cspan) st.colSpan = parseInt(cspan);

                        ParseContainer(st.stack, e, p, styles);
                        cnt.push(st);
                        break;
                    }
                    case "div":
                    case "p":
                    {
                        p = CreateParagraph();
                        var st = {
                            stack: []
                        }
                        st.stack.push(p);
                        ComputeStyle(st, styles);
                        ParseContainer(st.stack, e, p);

                        cnt.push(st);
                        break;
                    }
                    default:
                    {
                        console.log("Parsing for node " + e.nodeName + " not found");
                        break;
                    }
                }
                return p;
            }

            function ParseHtml(cnt, htmlText) {
                var html = $(htmlText.replace(/\t/g, "").replace(/\n/g, ""));
                var p = CreateParagraph();
                for (var i = 0; i < html.length; i++) ParseElement(cnt, html.get(i), p);
            }

            function CreateParagraph() {
                var p = {
                    text: []
                };
                return p;
            }
            content = [];
            ParseHtml(content, document.getElementById(id).outerHTML);
            return pdfMake.createPdf({
                content: content
            });
        }
    </script>


