@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Report Bug</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create-bug') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="summary" class="col-md-4 col-form-label text-md-right">Summary</label>
                            <div class="col-md-6">
                                <textarea id="summary" type="text" class="form-control @error('summary') is-invalid @enderror"
                                          style="height: 100px"
                                          name="summary" value="{{ old('summary') }}" required autocomplete="name" autofocus>
                                </textarea>

                                @error('summary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                          style="height: 200px"
                                          name="description" value="{{ old('description') }}" required autocomplete="name" autofocus>
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    Report Bug
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
