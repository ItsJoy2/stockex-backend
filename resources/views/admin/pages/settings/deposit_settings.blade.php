@extends('admin.layouts.app')

@section('content')
<div class="container mx-4">

    <h2>Deposit Bonus Settings</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.deposit.settings.update') }}" method="POST" style="width:98.5%;">
        @csrf
        <div class="mb-3">
            <label for="bonus_percentage" class="form-label">Deposit Bonus (%)</label>
            <input type="number" name="bonus_percentage" id="bonus_percentage"
                value="{{ old('bonus_percentage', $setting->bonus_percentage) }}"
                class="form-control" min="0" max="100" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="1" {{ $setting->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$setting->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

</div>
@endsection
