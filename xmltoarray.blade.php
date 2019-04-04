@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <?php


            $xml=simplexml_load_file("https://www.w3schools.com/xml/cd_catalog.xml") or die("Error: Cannot create object");
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);

            foreach ($array as $vienas) {
                foreach ($vienas as $du) {
            foreach ($du as $key => $value) {

                // $arr[3] will be updated with each value from $arr...
                echo "{$key} => {$value} ";}
                }}
            var_dump($array);
?>


                <table>
                    <tr>
                    <th>TITLE</th>
                    </tr>
                    @foreach ($array as $books)
                        @foreach ( $books as $ddd)
                            @foreach (  $ddd as $key => $value)
                        <tr>
                            <td>{{  $value }}</td>
                        </tr>
                    @endforeach
                    @endforeach
                    @endforeach










                </table>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
