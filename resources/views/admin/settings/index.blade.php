@extends('Layouts.admin')

@section('admin')
    <div class="container-fluid">
        <h2 class="h3 mb-2 text-gray-800">Website Settings</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Global Website Settings</h6>
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- IMPORTANT: enctype="multipart/form-data" for file upload --}}
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="logo">Website Logo:</label>
                        <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo">
                        <small class="form-text text-muted">Upload a new logo (PNG, JPG, JPEG, GIF - Max 2MB). Leave blank to keep current.</small>
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (isset($settings['logo']) && $settings['logo']->value)
                            <div class="mt-2">
                                <p>Current Logo:</p>
                                <img src="{{ asset($settings['logo']->value) }}" alt="Current Logo" style="max-width: 150px; height: auto; border-radius: 8px; background-color: #eee; padding: 5px;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $settings['phone_number']->value ?? '') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email_address">Email Address:</label>
                        <input type="email" class="form-control @error('email_address') is-invalid @enderror" id="email_address" name="email_address" value="{{ old('email_address', $settings['email_address']->value ?? '') }}">
                        @error('email_address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company_address">Company Address:</label>
                        <textarea class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" rows="3">{{ old('company_address', $settings['company_address']->value ?? '') }}</textarea>
                        @error('company_address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
@endsection
