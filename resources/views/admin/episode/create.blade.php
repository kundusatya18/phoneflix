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
                        <a class="btn btn-secondary" href="{{ route('admin.episode.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.episode.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="showId">Show</label>
                            <select name="showId" id="showId" class="form-control @error('showId') is-invalid @enderror">
                                @foreach($shows as $n)
                                <option value="{{$n->id}}">{{$n->title}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('showId') <span>{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name') {{ $message ?? '' }} @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="showtime">Duration <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('showtime') is-invalid @enderror" type="text" name="showtime" id="showtime" value="{{ old('showtime') }}"/>
                            @error('showtime') {{ $message ?? '' }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Image </label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="video">Video File<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('video') is-invalid @enderror" type="text" name="video" id="video" value="{{ old('video') }}"/>
                            @error('video') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                        <label class="control-label" for="type">Type <span class="m-l-5 text-danger"> *</span></label>
                        <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                            <option value="">Select Type</option>
                            <option value="1">Free</option>
                            <option value="2">Premium</option>
                        </select>
                        @error('type') {{ $message ?? '' }} @enderror
                    </div>
                        
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Episode</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.episode.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection