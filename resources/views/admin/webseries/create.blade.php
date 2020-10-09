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
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Webseries</button>
                        <a class="btn btn-secondary" href="{{ route('admin.webseries.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.webseries.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" readonly>
                                <option value="3">Webseries</option>
                            </select>
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('category_id') <span>{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="language_id">Language</label>
                            <select name="language_id" id="language_id" class="form-control @error('language_id') is-invalid @enderror">
                                <option value="">Select a Language</option>
                                @foreach($language as $languages)
                                    <option value="{{ $languages->id }}">{{ $languages->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback active">
                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('language_id') <span>{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Slug<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug') }}"/>
                            @error('slug') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Year Of Release <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('year_of_release') is-invalid @enderror" type="text" name="year_of_release" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  id="year_of_release" value="{{ old('year_of_release') }}"/>
                            @error('year_of_release') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Show Time<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('show_time') is-invalid @enderror" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="show_time" id="show_time" value="{{ old('show_time') }}"/>
                            @error('show_time') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Age Group<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('age_group') is-invalid @enderror" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="age_group" id="age_group" value="{{ old('age_group') }}"/>
                            @error('age_group') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Director<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('director') is-invalid @enderror" type="text" name="director" id="director" value="{{ old('director') }}"/>
                            @error('director') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="starrring">Starrring</label>
                            <textarea class="form-control" rows="4" name="starrring" id="starrring">{{ old('starrring') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Image 1</label>
                            <input class="form-control @error('image1') is-invalid @enderror" type="file" id="image1" name="image1"/>
                            @error('image1') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Image 2</label>
                            <input class="form-control @error('image2') is-invalid @enderror" type="file" id="image2" name="image2"/>
                            @error('image2') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Video File<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('video_file') is-invalid @enderror" type="text" name="video_file" id="video_file" value="{{ old('video_file') }}"/>
                            @error('video_file') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Trailer Video File<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('trailer_video_file') is-invalid @enderror" type="text" name="trailer_video_file" id="trailer_video_file" value="{{ old('trailer_video_file') }}"/>
                            @error('trailer_video_file') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Meta Key</label>
                        <input class="form-control @error('metakey') is-invalid @enderror" type="text" name="metakey" id="metakey" value="{{ old('metakey') }}" />
                        @error('metakey') {{ $message ?? '' }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Meta Description</label>
                         <textarea class="form-control" rows="4" name="metadescription" id="metadescription">{{ old('metadescription') }}</textarea>
                        @error('metadescription') {{ $message ?? '' }} @enderror
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Webseries</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.webseries.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection