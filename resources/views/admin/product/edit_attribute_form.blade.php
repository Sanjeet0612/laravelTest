@extends('admin.layout.layout')
@php
    $title='Edit & Update';
    $subTitle = 'Edit & Update';

@endphp

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Edit Attribute</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.update_attribute',$attribute->id) }}" method="POST">
                @csrf

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" value="{{ $attribute->subcategory->parent->category ?? '' }}" readonly>
                </div>

                {{-- Subcategory --}}
                <div class="mb-3">
                    <label class="form-label">Sub Category</label>
                    <input type="text" class="form-control" value="{{ $attribute->subcategory->category ?? '' }}" readonly>
                </div>

                {{-- Attribute Name --}}
                <div class="mb-3">
                    <label class="form-label">Attribute Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ $attribute->name }}" required>
                </div>

                {{-- Attribute Values --}}
                <div class="mb-3">
                    <label class="form-label">Attribute Values (Comma Separated)</label>

                    @php
                        $values = $attribute->values->pluck('value')->implode(',');
                    @endphp

                    <input type="text" name="values" class="form-control"
                        value="{{ $values }}" placeholder="Small,Medium,Large">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $attribute->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $attribute->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Attribute
                </button>

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Back
                </a>

            </form>
        </div>
    </div>
</div>

@endsection