@extends('layouts.app')

@section('content')
    <form action="{{route('admin.projects.store')}}" method="POST" >
        @csrf

        <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text"
            class="form-control" name="title" id="title" aria-describedby="" placeholder="title">
        </div>
        <div class="mb-3">
        <label for="description" class="form-label">descrizione</label>
        <input type="text"
            class="form-control" name="description" id="description" aria-describedby="" placeholder="descrizione..">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection