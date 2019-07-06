@extends('back.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="card">
                    <div class="card-header">
                        <strong>Create Group</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('groups.create') }}">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">
                                    Group Name
                                </label>
                                <input type="text" id="title" name="title" class="form-control">
                                
                                <div class="half-gutter-top">
                                    <button class="btn btn-primary btn-lg">
                                        Create Group
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- // container -->

@endsection