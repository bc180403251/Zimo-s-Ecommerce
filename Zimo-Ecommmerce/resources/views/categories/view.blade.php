@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ __('View Category') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea name="description" class="form-control" id="description" rows="4" readonly>{{ $category->description }}</textarea>
                            </div>
                            @if($category->parent_id)
                                <div class="form-group">
                                    <label for="parent_id">{{ __('Parent Category') }}</label>
                                    <input type="text" name="parent_id" class="form-control" id="parent_id" value="{{ $category->parent->name }}" readonly>
                                </div>
                            @endif
                            <div class="form-group text-right">
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
