<table hidden id="examplecopy10" class="table table-striped">
    <thead>
    <tr>

    <tr>
        <th>Produkto kodas</th>
        <th>Produktas</th>
        <th>Matas</th>
        <th>aprasymas</th>
        <th>Kiekis</th>
        <th>kaina</th>
        <th>suma</th>
    </tr>


    </thead>
    <tbody>
    <?php
            use Illuminate\Support\Facades\Auth;
    $skaiciususer = isset(Auth::user()->id) ? Auth::user()->id : Auth::user()->email;
    ?>
    @foreach ($kopijos as $recor)
        @if($recor->tag == $skaiciususer)
        <tr>

            <td>    {{  $recor->produkto_kodas }} </td>
            <td>    {{  $recor->produktas }} </td>
            <td>    {{  $recor->matas }} </td>
            <td>   {{  $recor->aprasymas }} </td>
            <td>    {{  $recor->kiekis }} </td>
            <td></td>
            <td></td>
        </tr>
@endif
    @endforeach


    </tbody>
</table>
