<table id="examplecopy10" class="table table-striped">
    <thead>
    <tr>

    <tr>
        <th>id</th>
        <th>Produkto kodas</th>
        <th>Produktas</th>
        <th>Matas</th>
        <th>Kiekis</th>
        <th>aprasymas</th>
        <th>KOREGUOTI</th>

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
            <td><a href="{{ route('nukreipymas2',$recor->id)}}" class="btn btn-primary">Edit</a></td>
        </tr>

    @endforeach


    </tbody>
</table>
