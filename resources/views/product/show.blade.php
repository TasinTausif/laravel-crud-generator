@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Details</h5>
            <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold">Title:</label>
                <p class="form-control-plaintext">{{ $item->title }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Description:</label>
                <p class="form-control-plaintext">{{ $item->description }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Created At:</label>
                <p class="form-control-plaintext">{{ $item->created_at }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning">Edit Product</a>
        </div>
    </div>
@endsection
