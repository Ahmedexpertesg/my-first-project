@extends('Layouts.admin')

@section('admin')
    <div class="container-fluid">
        <h2 class="h3 mb-2 text-gray-800">Homepage Sliders</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Manage Sliders</h6>
                <a class="btn btn-primary btn-sm" href="{{ route('admin.sliders.create') }}">
                    <i class="fas fa-plus"></i> Add New Slide
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>
                                        @if ($slider->image_path)
                                            <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->title }}" style="max-width: 100px; height: auto; border-radius: 4px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->subtitle }}</td>
                                    <td>
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slide? This action cannot be undone.');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready( function () {
        $('#dataTable').DataTable(); // Initialize DataTable if you use it
    });
</script>
@endpush
