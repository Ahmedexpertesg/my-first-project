@extends('Layouts.admin')

@section('admin')
    <div class="container-fluid">
        <h2 class="h3 mb-2 text-gray-800">Add New Slider Item</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create New Slide</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" required>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                        @error('subtitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button1_text">Button 1 Text:</label>
                        <input type="text" class="form-control @error('button1_text') is-invalid @enderror" id="button1_text" name="button1_text" value="{{ old('button1_text') }}">
                        @error('button1_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button1_link">Button 1 Link:</label>
                        <input type="text" class="form-control @error('button1_link') is-invalid @enderror" id="button1_link" name="button1_link" value="{{ old('button1_link') }}">
                        @error('button1_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button2_text">Button 2 Text:</label>
                        <input type="text" class="form-control @error('button2_text') is-invalid @enderror" id="button2_text" name="button2_text" value="{{ old('button2_text') }}">
                        @error('button2_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button2_link">Button 2 Link:</label>
                        <input type="text" class="form-control @error('button2_link') is-invalid @enderror" id="button2_link" name="button2_link" value="{{ old('button2_link') }}">
                        @error('button2_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Slide</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
