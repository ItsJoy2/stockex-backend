{{-- Page (Read Only) --}}
<div class="mb-3">
    <label class="form-label">Page</label>
    <input type="text"
           class="form-control"
           value="{{ $banner->page }}"
           readonly>
</div>

{{-- Title --}}
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title', $banner->title) }}">
</div>

{{-- Image --}}
<div class="mb-3">
    <label class="form-label">Image <small class="text-muted">(1280x300px)</small></label>
    <input type="file"
           name="image"
           class="form-control"
           onchange="previewImage(event)">

    {{-- Existing preview --}}
    <div class="mt-2">
        @if($banner->image)
            <img id="imagePreview" src="{{ asset('storage/'.$banner->image) }}" width="200" class="img-thumbnail">
        @else
            <img id="imagePreview" src="" style="display:none;" width="200" class="img-thumbnail">
        @endif
    </div>
</div>

{{-- Status --}}
<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>


<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');
    if(input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
