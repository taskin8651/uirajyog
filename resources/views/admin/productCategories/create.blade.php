@extends('layouts.admin')
@section('page-title', 'Add Product Category')

@section('styles')
<style>
.form-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #E2E8F0;
    overflow: hidden;
}
.form-card-header {
    padding: 16px 22px;
    border-bottom: 1px solid #F1F5F9;
    display: flex; align-items: center; gap: 10px;
}
.form-card-icon {
    width: 34px; height: 34px; border-radius: 9px;
    background: var(--accent-light); color: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; flex-shrink: 0;
}
.form-card-body { padding: 22px; }
.field-label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.field-input, .field-textarea, .field-select {
    width:100%; padding:11px 14px; border:1.5px solid #E2E8F0; border-radius:9px;
    font-size:13.5px; color:#1E293B; outline:none; background:#fff; font-family:inherit;
}
.field-input:focus, .field-textarea:focus, .field-select:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(79,70,229,.12); }
.field-textarea { min-height:130px; resize:vertical; }
.field-hint { font-size:12px; color:#94A3B8; margin-top:6px; }
.field-error { font-size:12px; color:#EF4444; margin-top:6px; }
.btn-primary {
    display:inline-flex; align-items:center; gap:8px;
    padding:10px 22px; border-radius:10px; background:var(--accent);
    color:#fff; font-size:13.5px; font-weight:600; border:none; cursor:pointer;
}
.btn-primary:hover { opacity:.88; }
.btn-ghost {
    display:inline-flex; align-items:center; gap:8px;
    padding:10px 20px; border-radius:10px; border:1.5px solid #E2E8F0;
    color:#475569; background:#F8FAFC; text-decoration:none;
}
.image-preview {
    width:100%; max-width:200px; border-radius:12px; margin-top:12px; border:1px solid #E2E8F0;
}
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.product-categories.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to list</a>
        </div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Add Product Category</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Create a new category for your products.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.product-categories.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-tags"></i></div>
            <div>
                <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Category Details</p>
                <p style="font-size:12px; color:#94A3B8; margin:0;">Enter the information for this category.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div style="display:grid; gap:20px;">
                <div>
                    <label class="field-label" for="name">Name <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="field-input {{ $errors->has('name') ? 'error' : '' }}" placeholder="Category name">
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="description">Description</label>
                    <textarea name="description" id="description" class="field-textarea" placeholder="Write a short description...">{{ old('description') }}</textarea>
                    @error('description')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="field-input">
                    <img id="preview-image" class="image-preview" style="display:none;" src="" alt="Preview">
                    @error('image')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="field-input" placeholder="0">
                        @error('sort_order')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div style="display:flex; align-items:center; gap:14px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                            <input type="checkbox" name="status" value="1" class="field-input" style="width:auto; padding:0; height:auto; margin:0; border:none; background:transparent;">
                            <span style="font-size:13px; color:#374151;">Active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; gap:12px; flex-wrap:wrap;">
        <button type="submit" class="btn-primary">Save Category</button>
        <a href="{{ route('admin.product-categories.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
<script>
$('#image').on('change', function(e) {
    const [file] = this.files;
    if (!file) {
        $('#preview-image').hide();
        return;
    }
    $('#preview-image').attr('src', URL.createObjectURL(file)).show();
});
</script>
@endsection
