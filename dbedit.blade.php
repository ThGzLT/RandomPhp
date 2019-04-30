@extends('layouts.test')

@section('content')
    <?php use Illuminate\Support\Facades\Auth; ?>

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Prideti Prekę
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
                <form method="post" action="{{ route('Copytodb') }}">
                        @csrf
                    <div class="form-group">
                        <label for="price">{{  $record->produkto_kodas }} :</label>
                        <input type="text" class="form-control" name="produkto_kodas" value="{{  $record->produkto_kodas }}"/>
                    </div>
                    <div class="form-group">
                        <label for="price"> {{  $record->produktas }} :</label>
                        <input type="text" class="form-control" name="produktas" value="{{  $record->produktas }}"/>
                    </div>
                    <div class="form-group">
                        <label for="quantity">{{  $record->matas }}</label>
                        <input type="text" class="form-control" name="matas" value="{{  $record->matas }}"/>
                    </div>
                    <div class="form-group">
                        <label for="quantity">{{  $record->kiekis }}</label>
                        <input type="text" class="form-control" name="kiekis" value="{{  $record->kiekis }}"/>
                    </div>
                    <div hidden class="form-group">
                        <label for="quantity">{{  $record->tag }}</label>
                        <input type="text" class="form-control" name="tag" value="{{  isset(Auth::user()->id) ? Auth::user()->id : Auth::user()->email  }}"/>
                    </div>
                    <button id="modal" type="submit" class="btn btn-primary">Pridėti</button>
            </form>
        </div>
    </div>
    <script>
        jQuery(function(){
            jQuery('#modal').click();
        });
    </script>
@endsection
