@extends('back.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">

            @foreach ($groups as $group)

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="center half-gutter-top half-gutter-bottom">
                                <a href="{{ route('groups.switchGroup', ['group_id' => $group->id]) }}" class="btn btn-lg btn-primary">
                                    {{ $group->title }}
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    </div> <!-- // container -->

@endsection