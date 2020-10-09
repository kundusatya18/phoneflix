@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Genre</button>
                    <a class="btn btn-secondary" href="{{ route('admin.genres.index') }}"><i class="fa fa-fw fa-lg fa fa-angle-left"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="alert alert-success" id="success-msg" style="display: none;">
        <span id="success-text"></span>
    </div>
    <div class="alert alert-danger" id="error-msg" style="display: none;">
        <span id="error-text"></span>
    </div>
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <form action="{{ route('admin.genres.update') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                    @csrf
                    <div class="tile-body form-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $targetGenre->name) }}"/>
                            <input type="hidden" name="id" value="{{ $targetGenre->id }}">
                            @error('name') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Slug <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug',$targetGenre->slug) }}"/>
                            @error('slug') {{ $message }} @enderror
                        </div>
                    <div class="form-group">
                        <label class="control-label" for="metakey">Meta Key</label>
                        <input class="form-control @error('metakey') is-invalid @enderror" type="text" name="metakey" id="metakey" value="{{ old('metakey',$targetGenre->metakey) }}" />
                        @error('metakey') {{ $message ?? '' }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="metadescription">Meta Description</label>
                         <textarea class="form-control" rows="4" name="metadescription" id="metadescription">{{ old('metadescription',$targetGenre->metadescription) }}</textarea>
                        @error('metadescription') {{ $message ?? '' }} @enderror
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    </script>
@endpush