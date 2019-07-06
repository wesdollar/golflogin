@extends('back.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <strong>Add Course</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('courses.create') }}">

                            {{ csrf_field() }}

                            <div class="row small-gutter-bottom">
                                <div class="col-md-4 offset-md-2">
                                    <div class="form-group">
                                        <label for="course-name">
                                            Course Name
                                        </label>
                                        <input type="text" class="form-control" name="courseName" id="course-name">
                                    </div>
                                </div>
                            </div>
                            <div class="row small-gutter-bottom">
                                <div class="col-md-4 offset-md-2">
                                    <div class="form-group">
                                        <label for="tee-box">
                                            Tee Box
                                        </label>
                                        <input type="text" class="form-control" name="teeBox" id="tee-box">
                                    </div>
                                </div>
                            </div>
                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 offset-md-2">
                                    <div class="form-group">
                                        <label for="usga-rating">
                                            USGA Rating
                                        </label>
                                        <input type="text" class="form-control" name="usgaRating" id="usga-rating">
                                    </div>
                                </div>
                            </div>
                            <div class="row half-gutter-bottom">
                                <div class="col-md-2 offset-md-2">
                                    <div class="form-group">
                                        <label for="slope-rating">
                                            Slope Rating
                                        </label>
                                        <input type="text" class="form-control" name="slopeRating" id="slope-rating">
                                    </div>
                                </div>
                            </div>

                            <div id="front-9">
                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Hole</strong>
                                    </div>

                                    @for ($i = 1; $i <= 9; $i++)
                                        <div class="col-md-1 center">
                                            {{ $i }}
                                        </div>
                                    @endfor
                                </div> <!-- // holes row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Par</strong>
                                    </div>

                                    @for ($i = 1; $i <= 9; $i++)
                                        <div class="col-md-1 center">
                                            <label for="par{{ $i }}" class="sr-only">Hole {{ $i }} Par</label>
                                            <input id="par{{ $i }}" type="text" class="form-control center" name="pars[{{ $i }}]">
                                        </div>
                                    @endfor
                                </div> <!-- // pars row -->

                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <strong>Yardage</strong>
                                    </div>

                                    @for ($i = 1; $i <= 9; $i++)
                                        <div class="col-md-1 center">
                                            <label for="yardage{{ $i }}" class="sr-only">Hole {{ $i }} Yardage</label>
                                            <input id="yardage{{ $i }}" type="text" class="form-control center" name="yardages[{{ $i }}]">
                                        </div>
                                    @endfor
                                </div> <!-- // yardages row -->
                            </div> <!-- // front nine -->

                            <div id="back-9" class="half-gutter-top">
                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Hole</strong>
                                    </div>

                                    @for ($i = 10; $i <= 18; $i++)
                                        <div class="col-md-1 center">
                                            {{ $i }}
                                        </div>
                                    @endfor
                                </div> <!-- // holes row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Par</strong>
                                    </div>

                                    @for ($i = 10; $i <= 18; $i++)
                                        <div class="col-md-1 center">
                                            <label for="par{{ $i }}" class="sr-only">Hole {{ $i }} Par</label>
                                            <input id="par{{ $i }}" type="text" class="form-control center" name="pars[{{ $i }}]">
                                        </div>
                                    @endfor
                                </div> <!-- // pars row -->

                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <strong>Yardage</strong>
                                    </div>

                                    @for ($i = 10; $i <= 18; $i++)
                                        <div class="col-md-1 center">
                                            <label for="yardage{{ $i }}" class="sr-only">Hole {{ $i }} Yardage</label>
                                            <input id="yardage{{ $i }}" type="text" class="form-control center" name="yardages[{{ $i }}]">
                                        </div>
                                    @endfor
                                </div> <!-- // yardages row -->
                            </div> <!-- // front nine -->

                            <div class="row half-gutter-top">
                                <div class="col offset-md-2">
                                    <button class="btn btn-primary btn-lg">
                                        Add Course
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