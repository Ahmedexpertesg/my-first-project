<h1>Edit Product</h1>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<hr />
<div class="row">
    <div class="col-md-6 offset-md-3">

        <form action="/storeproduct" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Validation Summary --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" name="id" value="{{ $product->id }}">

            {{-- Product Name --}}
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>

            {{-- Description --}}
            <div class="form-group mb-3">
                <label>Description</label>
                <input type="text" name="description" value="{{ $product->description }}" class="form-control">
            </div>

            {{-- Price --}}
            <div class="form-group mb-3">
                <label>Price</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control">
            </div>

            {{-- Quantity --}}
            <div class="form-group mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
            </div>

            {{-- Category --}}
            <div class="form-group mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($allCategories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Main Image --}}
            <div class="form-group mb-3">
                <label>Main Image</label><br>
                <img src="{{ asset($product->imagepath) }}" width="150" class="mb-2">
                <input type="file" name="image" class="form-control">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Additional Images --}}
            <div class="form-group mb-3">
                <label>Upload Additional Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
                @error('images.*')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Previously Uploaded Additional Images --}}
            @if ($product->images && $product->images->count())
                <div class="form-group mb-3">
                    <label>Existing Images</label><br>
                    @foreach ($product->images as $img)
                        <img src="{{ asset($img->image_path) }}" width="100" class="me-2 mb-2 rounded border">
                    @endforeach
                </div>
            @endif

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
