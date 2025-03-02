@extends('layouts.app')

@section('content')
{{-- pass task to edit php --}}
    @include('form', ['task' => $task])

@endsection
