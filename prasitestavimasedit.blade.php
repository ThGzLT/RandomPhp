@extends('layouts.test')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
ĮVESTI APRAŠYMĄ
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
            <form method="post" action="{{ route('Copytodb2',$recor->id) }}">
                <div class="form-group">
                    @csrf
                    {{ method_field('PATCH') }}

                    <label for="aprasymas">{{  $recor->aprasymas }}</label>
                    <input type="text" class="form-control" name="aprasymas"/>
                </div>
                <button type="submit" class="btn btn-primary">PRIDĖTI</button>
            </form>
        </div>
    </div>
@endsection