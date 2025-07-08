<h1>Create Category</h1>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<hr />

<div class="row">
    <div class="col-md-6 offset-md-3">

        <form action="/storecategory" method="POST"  enctype="multipart/form-data">
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

            {{-- category Name --}}
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input required type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>

            {{--category image--}}
            <div class="form-group">
                        <label for="image">Category Image:</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" required>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


            <button type="submit" class="btn btn-success">Save Category</button>
        </form>

    </div>
</div>
