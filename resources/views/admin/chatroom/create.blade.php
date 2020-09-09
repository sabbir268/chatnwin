@extends('layouts.admin.layout')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection
@section('content')

<style>
    .card.card-statistics {
        background: linear-gradient(85deg, #06b76b, #f5a623);
        color: #ffffff;
    }
</style>
<div class="main-panel" style="width: 100% !important;">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">

            </h3>
        </div>
        <div class="row grid-margin">
            <div class="col-12">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                <form action="{{ route('chatroom.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>
                                    <h5>Chat Room Name</h5>
                                </label>
                                <input type="text" class="form-control rounded-0" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="is-invalid text-danger mt-2 font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>
                                    <h5>Upload image <small>(300*300 px)</small></h5>
                                </label>
                                <input type="file" class="dropify" name="photo" />
                                @error('photo')
                                <div class="is-invalid text-danger mt-2 font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <input type="submit" class="btn btn-dark rounded-0 pl-5 pr-5 pt-3 pb-3" value="Upload"
                                    style="background: #000" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});
</script>
@endsection