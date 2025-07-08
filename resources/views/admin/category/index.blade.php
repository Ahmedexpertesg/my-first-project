


@extends ('Layouts.admin')

@section('admin')



<div class="container-fluid">

    <h2 class="h3 mb-2 text-gray-800">Categories</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>

            <a class="btn btn-primary" href="{{route('admin.category.create')}}">Create New Category</a>
        </div>
        <div class="card-body">

             @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ADD THIS BLOCK FOR ERROR MESSAGES --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                {{------------------------------------}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Actions</th> {{-- Actions column --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allCats as $cat)
                            <tr>

                                <td>
                                    {{ $cat->id }}
                                </td>

                                <td>
                                    {{ $cat->name }}
                                </td>
                                <td>

                                   <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-warning btn-sm">Edit</a> |



                                    {{-- Delete Button Form --}}
                                        <form action="{{ route('category.destroy', $cat->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE') {{-- This tells Laravel to treat this as a DELETE request --}}
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.');">Delete</button>
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
    let table = new DataTable('#dataTable');
} );
</script>

@endpush

