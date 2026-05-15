@extends('layouts.app')

@section('content')
<div class="card shadow-lg">
    <div class="card-header d-flex justify-content-between align-items-center py-3 px-4">
        <h4 class="mb-0 fw-bold">Foods List</h4>
        <a href="{{ route('foods.create') }}" class="btn btn-create">
            + Create New Foods
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th style="width:70px">ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="width:180px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($foods as $item)
                <tr>
                    <td><span class="badge-id">{{ $item->id }}</span></td>
                    <td class="fw-semibold">{{ $item->title }}</td>
                    <td class="text-secondary">{{ $item->description }}</td>
                    <td>
                        <a href="{{ route('foods.show', $item->id) }}" class="btn btn-view btn-sm me-1">View</a>
                        <a href="{{ route('foods.edit', $item->id) }}" class="btn btn-edit btn-sm me-1">Edit</a>
                        <form action="{{ route('foods.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-sm"
                                onclick="return confirm('Delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-secondary py-4">No records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection