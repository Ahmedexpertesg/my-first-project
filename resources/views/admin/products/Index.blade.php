


@extends ('Layouts.admin')

@section('admin')



<div class="container-fluid">

    <h2 class="h3 mb-2 text-gray-800">Products</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            {{-- Link to create a new product --}}
            <a class="btn btn-primary" href="\addProduct">Create New Product</a>
            {{-- Assuming you have a route named 'products.create' for your product creation form --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                           {{-- <th>Category</th>--}}
                            <th>Price</th>
                            <th>Actions</th> {{-- Actions column --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allProducts as $product)
                            <tr>
                                <td>

                                    <img src="{{asset($product->imagepath) }}" width="200"  />
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>

                               {{--<td>

                                    {{ $product->category->name }}
                                </td>--}}
                                <td>
                                    {{ $product->price }} {{-- Display product price --}}
                                </td>
                                <td>
                                    {{-- Action links for Edit, Details, Delete --}}
                                    {{-- Use route() helper with named routes and pass the product ID --}}
                                    <a href="editproduct/{{$product->id}}" class="btn btn-primary">Edit</a> |
                                    <a href="" class="btn btn-primary">Details</a> |
                                    {{--<a href="removeproduct/{{$product->id}}" class="btn btn-primary">Delete</a>--}}

                                     <a class="btn btn-primary" href="removeproduct/{{$product->id}}"
                                    onclick="event.preventDefault(); if (confirm('هل انت متاكد من حذف هذا المنتج؟')) {document.getElementById('delete-form-{{$product->id}}').submit();}">
                                        Delete
                                    </a>
                                    <form id="delete-form-{{$product->id}}" action="removeproduct/{{$product->id}}" method="POST" style="display: none;">
                                        @csrf {{-- Laravel CSRF token for security --}}
                                        @method('DELETE') {{-- This tells Laravel to treat this POST request as a DELETE request --}}
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

