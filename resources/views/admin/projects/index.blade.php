@extends('layouts.app')

@section('content')

    @foreach($project as $element)
   
    <a href="{{ route('admin.projects.show', $element) }}">{{ $element['title'] }}</a>
    
    @endforeach

@endsection