@extends('layouts.admin')
@section('page-title', 'Add Product')

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

.field-label {
    display: block; font-size: 13px; font-weight: 600;
    color: #374151; margin-bottom: 6px;
}
.field-label .req { color: #EF4444; margin-left: 2px; }
.field-input, .field-textarea, .field-select {
    width: 100%; padding: 9px 13px;
    border: 1.5px solid #E2E8F0; border-radius: 9px;
    font-size: 13.5px; color: #1E293B; outline: none;
    transition: border-color .2s, box-shadow .2s;
    background: #fff; font-family: inherit;
}
.field-input:focus, .field-textarea:focus, .field-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
}
.field-textarea { min-height: 120px; resize: vertical; }
.field-input.error, .field-select.error, .field-textarea.error { border-color: #EF4444; }
.field-input.error:focus, .field-textarea.error:focus, .field-select.error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.15); }
.field-hint { font-size: 12px; color: #94A3B8; margin-top: 5px; }
.field-error {
    font-size: 12px; color: #EF4444;
    margin-top: 5px; display:flex; align-items:center; gap:4px;
}
.field-group { margin-bottom: 20px; }
.field-group:last-child { margin-bottom: 0; }

.btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 22px; border-radius: 10px;
    background: var(--accent); color: #fff;
    font-size: 13.5px; font-weight: 600; border: none;
    cursor: pointer; transition: opacity .2s; font-family: inherit;
}
.btn-primary:hover { opacity: .88; }
.btn-ghost {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 18px; border-radius: 10px;
    background: #F8FAFC; color: #475569;
    font-size: 13.5px; font-weight: 600; border: 1.5px solid #E2E8F0;
    cursor: pointer; text-decoration: none; transition: background .15s;
    font-family: inherit;
}
.btn-ghost:hover { background: #F1F5F9; }
.image-preview { width: 100%; max-width: 220px; border-radius: 12px; margin-top: 12px; border: 1px solid #E2E8F0; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.products.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to list</a>
        </div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Add Product</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Fill in the catalog details for the new product.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-box-open"></i></div>
            <div>
                <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Product Details</p>
                <p style="font-size:12px; color:#94A3B8; margin:0;">Enter basic product information and media.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div style="display:grid; gap:20px;">
                <div>
                    <label class="field-label" for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="field-select">
                        <option value="">Select category</option>
                        @foreach($categories as $id => $label)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="field-label" for="name">Name <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="field-input" placeholder="Product name">
                    @error('name')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="field-label" for="short_description">Short Description</label>
                    <textarea name="short_description" id="short_description" class="field-textarea" placeholder="Short summary...">{{ old('short_description') }}</textarea>
                    @error('short_description')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="field-label" for="description">Description</label>
                    <textarea name="description" id="description" class="field-textarea" placeholder="Full description...">{{ old('description') }}</textarea>
                    @error('description')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                </div>
                <div style="display:grid; gap:20px;">
                    <div>
                        <label class="field-label" for="features">Features</label>
                        <textarea name="features" id="features" class="field-textarea" placeholder="Product features...">{{ old('features') }}</textarea>
                        @error('features')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="ingredients">Ingredients</label>
                        <textarea name="ingredients" id="ingredients" class="field-textarea" placeholder="Ingredients list...">{{ old('ingredients') }}</textarea>
                        @error('ingredients')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="usage_instruction">Usage Instruction</label>
                        <textarea name="usage_instruction" id="usage_instruction" class="field-textarea" placeholder="How to use...">{{ old('usage_instruction') }}</textarea>
                        @error('usage_instruction')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); gap:20px;">
                    <div>
                        <label class="field-label" for="pack_size">Pack Size</label>
                        <input type="text" name="pack_size" id="pack_size" value="{{ old('pack_size') }}" class="field-input" placeholder="e.g. 250g">
                        @error('pack_size')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="price">Price</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" class="field-input" placeholder="0.00">
                        @error('price')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="field-input" placeholder="0">
                        @error('sort_order')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:grid; gap:20px;">
                    <div>
                        <label class="field-label" for="image">Main Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="field-input">
                        <img id="preview-image" class="image-preview" style="display:none;" src="" alt="Preview">
                        @error('image')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="images">Gallery Images</label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple class="field-input">
                        <p class="field-hint">Upload multiple images for the product gallery.</p>
                        @error('images')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                        @error('images.*')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:20px; align-items:center;">
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="status" value="1" {{ old('status') ? 'checked' : '' }} style="width:auto; margin:0; border:none; background:transparent;">
                        <span style="font-size:13px; color:#374151;">Active</span>
                    </label>
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width:auto; margin:0; border:none; background:transparent;">
                        <span style="font-size:13px; color:#374151;">Featured</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; gap:12px; flex-wrap:wrap;">
        <button type="submit" class="btn-primary"><i class="fas fa-check" style="font-size:11px;"></i> Save Product</button>
        <a href="{{ route('admin.products.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
@parent
<script>
$(function() {
    $('#category_id').select2({ width: '100%', placeholder: 'Select category' });
    ClassicEditor.create(document.querySelector('#description')).catch(() => {});
    ClassicEditor.create(document.querySelector('#features')).catch(() => {});
    ClassicEditor.create(document.querySelector('#ingredients')).catch(() => {});
    ClassicEditor.create(document.querySelector('#usage_instruction')).catch(() => {});

    $('#image').on('change', function() {
        const [file] = this.files;
        if (!file) return;
        $('#preview-image').attr('src', URL.createObjectURL(file)).show();
    });
});
</script>
@endsection
