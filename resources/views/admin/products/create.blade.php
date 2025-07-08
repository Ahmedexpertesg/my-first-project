<h1>Create Product</h1>

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

            {{-- Product Name --}}
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>

            {{-- Description --}}
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <input type="text" name="description" value="{{ old('description') }}" class="form-control">
            </div>

            {{-- Price --}}
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control">
            </div>

            {{-- Quantity --}}
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control">
            </div>

            {{-- Category --}}
            <div class="form-group mb-3">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($allCategories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Main Image --}}
            <div class="form-group mb-3">
                <label for="image">Main Image</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Multiple Images --}}
            <div class="form-group ms-5" id="image-upload-group">
                <label for="images" class="control-label">Additional Images</label>
                <div class="d-flex mb-2">
                    <input type="file" name="images[]" class="form-control me-2" />
                    <button type="button" class="btn btn-sm btn-primary" id="addImageInput">+</button>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save Product</button>
        </form>

    </div>
</div>


{{--for additional images--}}
<script>
    document.getElementById('addImageInput').addEventListener('click', function () {
        let group = document.createElement('div');
        group.classList.add('d-flex', 'mb-2');

        let input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.classList.add('form-control', 'me-2');

        let removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
        removeBtn.innerText = '−';
        removeBtn.onclick = () => group.remove();

        group.appendChild(input);
        group.appendChild(removeBtn);

        document.getElementById('image-upload-group').appendChild(group);
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
