@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="fixed-row">
        <div class="app-title">
            <div class="active-wrap">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                    <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}"><i style="vertical-align: baseline;" class="fa fa-chevron-left"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <form action="{{ route('admin.categories.store') }}" method="POST" role="form" enctype="multipart/form-data" id="form1">
                    @csrf
                    <div class="tile-body form-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Slug <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug') }}"/>
                            @error('slug') {{ $message }} @enderror
                        </div>
                    <div class="form-group">
                        <label class="control-label" for="metakey">Meta Key</label>
                        <input class="form-control @error('metakey') is-invalid @enderror" type="text" name="metakey" id="metakey"  value="{{ old('metakey') }}" />
                        @error('metakey') {{ $message ?? '' }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="metadescription">Meta Description</label>
                         <textarea class="form-control" rows="4" name="metadescription" id="metadescription">{{ old('metadescription') }}</textarea>
                        <!--<input class="form-control @error('metadescription') is-invalid @enderror" type="text" name="metadescription" id="metadescription" value="{{ old('metadescription') }}" />-->
                        @error('metadescription') {{ $message ?? '' }} @enderror
                    </div>
                        
                        {{-- <div class="form-group toogle-lg">
                            <label class="control-label">Status</label>
                            <div class="toggle-button-cover">
                                <div class="button-cover">
                                    <div class="button-togglr b2" id="button-11">
                                        <input id="toggle-block" type="checkbox" name="status" class="checkbox">
                                        <div class="knobs"><span>Inactive</span></div>
                                        <div class="layer"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnSave").on("click",function(){
            $('#form1').submit();
        })
    })
</script>
@endpush