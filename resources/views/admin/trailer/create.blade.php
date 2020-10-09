@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}
                    <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Trailer</button>
                        <a class="btn btn-secondary" href="{{ route('admin.trailer.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.trailer.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Movie Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('movieName') is-invalid @enderror" type="text" name="movieName" id="movieName" value="{{ old('movieName') }}"/>
                            @error('movieName') {{ $message ?? '' }} @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Trailer Image<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Trailer File Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('trailerName') is-invalid @enderror" type="text" name="trailerName" id="trailerName" value="{{ old('trailerName') }}"/>
                            @error('trailerName') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Trailer</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.trailer.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection