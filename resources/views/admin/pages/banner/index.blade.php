@extends('admin.layouts.app')

@section('content')

    {{-- SweetAlert success --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">All Banners</h4>
        </div>

        <div class="card-body table-responsive">

            {{-- Filter --}}
            {{-- <form method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <select name="filter" class="form-control">
                            <option value="">-- Filter Status --</option>
                            <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ request('filter') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit">Filter</button>
                        <a href="{{ route('banners.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form> --}}

            {{-- Table --}}
            <table class="table table-striped table-hover mt-3">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Page</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th width="120">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($banners as $index => $banner)
                    <tr>
                        <td>{{ $index + $banners->firstItem() }}</td>

                        <td>
                            <span class="badge bg-info text-dark">
                                {{ strtoupper(str_replace('_',' ', $banner->page)) }}
                            </span>
                        </td>

                        <td>{{ $banner->title ?? '-' }}</td>

                        <td>
                            @if($banner->image)
                                <img src="{{ asset('storage/'.$banner->image) }}"
                                     width="80"
                                     class="img-thumbnail">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>
                            <span class="badge {{ $banner->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $banner->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('banners.edit', $banner->id) }}"
                               class="btn btn-sm btn-info">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No banners found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $banners->links('admin.layouts.partials.__pagination') }}
            </div>
        </div>
    </div>
@endsection
