@extends('layouts.app')

@section('title', 'wallets list')

@section('content')

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    <form action="{{ isset($wallet) ? route('wallets.update', $wallet->uuid) : route('wallets.store') }}" method="POST">
        @csrf
        @isset($wallet)
            @method('PATCH')
        @endisset
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $wallet->title ?? '') }}" required>

            @error('title')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $wallet->description ?? '') }}</textarea>

            @error('description')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>

        </div>
        <button type="submit" class="btn btn-primary mt-4">Create Wallet</button>
    </form>

@endsection

