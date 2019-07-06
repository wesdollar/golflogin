@extends('back.layout')

@section('content')

    <card-component :courses="{{ $courses }}"
                    :holes="{{ $holes }}"
                    :meta="{{ $meta }}"
                    csrf_token="{{ csrf_token() }}"></card-component>

@endsection