@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-lg">
            <div class="card-header py-3 px-4">
                <h4 class="mb-0 fw-bold">Foods Detail</h4>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <span class="form-label d-block">Title</span>
                    <p class="fw-semibold fs-5 mb-0">{{ $foods->title }}</p>
                </div>
                <div class="mb-4">
                    <span class="form-label d-block">Description</span>
                    <p class="text-secondary mb-0">{{ $foods->description ?? '—' }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('foods.edit', $foods->id) }}" class="btn btn-edit">Edit</a>
                    <a href="{{ route('foods.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection