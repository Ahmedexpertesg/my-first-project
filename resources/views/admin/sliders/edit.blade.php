@extends('Layouts.admin')

@section('admin')
    <div class="container-fluid">
        <h2 class="h3 mb-2 text-gray-800">Edit Slider Item</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Slide: {{ $slider->title }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="image">Slide Image:</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                        <small class="form-text text-muted">Upload a new image (PNG, JPG, JPEG, GIF - Max 2MB). Leave blank to keep current.</small>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if ($slider->image_path)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->title }}" style="max-width: 150px; height: auto; border-radius: 8px; background-color: #eee; padding: 5px;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}">
                        @error('subtitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $slider->title) }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button1_text">Button 1 Text:</label>
                        <input type="text" class="form-control @error('button1_text') is-invalid @enderror" id="button1_text" name="button1_text" value="{{ old('button1_text', $slider->button1_text) }}">
                        @error('button1_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button1_link">Button 1 Link:</label>
                        <input type="text" class="form-control @error('button1_link') is-invalid @enderror" id="button1_link" name="button1_link" value="{{ old('button1_link', $slider->button1_link) }}">
                        @error('button1_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button2_text">Button 2 Text:</label>
                        <input type="text" class="form-control @error('button2_text') is-invalid @enderror" id="button2_text" name="button2_text" value="{{ old('button2_text', $slider->button2_text) }}">
                        @error('button2_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button2_link">Button 2 Link:</label>
                        <input type="text" class="form-control @error('button2_link') is-invalid @enderror" id="button2_link" name="button2_link" value="{{ old('button2_link', $slider->button2_link) }}">
                        @error('button2_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Slide</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
