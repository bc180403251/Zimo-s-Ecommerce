@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Banner Details') }}</h1>
                    </div><!-- /.col -->
                   <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Banner Details -->
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{$banner->imgUrl}}" alt="{{ $banner->name }}" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>
                <h2 class="text-center">{{ $banner->name }}</h2>
                <p class="text-center">
                    <strong>Status:</strong>
                    @if($banner->status)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-secondary">Inactive</span>
                    @endif
                </p>
                <hr>
                <p>{{ $banner->details }}</p>
            </div>
            <div class="mb-2 mr-3 text-right">
                <a href="{{ route('banners.index') }}" class="btn btn-outline-secondary">{{ __('Back to Banners') }}</a>
            </div>
        </div>
    </div>
@endsection
