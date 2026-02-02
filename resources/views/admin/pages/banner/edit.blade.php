@extends('admin.layouts.app')

@section('content')
<div class="p-5">
    <h4>Edit Banner</h4>

    <form method="POST" action="{{ route('banners.update', $banner->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.pages.banner.form', ['banner' => $banner])

        <button type="submit" class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection
