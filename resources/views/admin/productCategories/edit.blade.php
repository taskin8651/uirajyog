@extends('layouts.admin')
@section('page-title', 'Edit Product Category')

@section('styles')
<style>
.form-card { background: #fff; border-radius: 14px; border: 1px solid #E2E8F0; overflow: hidden; }
.form-card-header { padding: 16px 22px; border-bottom: 1px solid #F1F5F9; display: flex; align-items: center; gap: 10px; }
.form-card-icon { width: 34px; height: 34px; border-radius: 9px; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 14px; }
.form-card-body { padding: 22px; }
.field-label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
.field-input, .field-textarea { width: 100%; padding: 9px 13px; border: 1.5px solid #E2E8F0; border-radius: 9px; font-size: 13.5px; color: #1E293B; outline: none; background: #fff; font-family: inherit; }
.field-input:focus, .field-textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent); }
.field-textarea { min-height: 130px; resize: vertical; }
.field-hint { font-size: 12px; color: #94A3B8; margin-top: 5px; }
.field-error { font-size: 12px; color: #EF4444; margin-top: 5px; display:flex; align-items:center; gap:4px; }
.field-group { margin-bottom: 20px; }
.field-group:last-child { margin-bottom: 0; }
.btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 10px; background: var(--accent); color: #fff; font-size: 13.5px; font-weight: 600; border: none; cursor: pointer; transition: opacity .2s; font-family: inherit; }
.btn-primary:hover { opacity: .88; }
.btn-ghost { display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border-radius: 10px; background: #F8FAFC; color: #475569; font-size: 13.5px; font-weight: 600; border: 1.5px solid #E2E8F0; cursor: pointer; text-decoration: none; transition: background .15s; font-family: inherit; }
.btn-ghost:hover { background: #F1F5F9; }
.image-preview { width: 100%; max-width: 220px; border-radius: 12px; margin-top: 12px; border: 1px solid #E2E8F0; }
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.product-categories.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to list</a>
        </div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Edit Product Category</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Update category name and settings.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.product-categories.update', $productCategory->id) }}" enctype="multipart/form-data">
    @method('PUT') @csrf

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-tags"></i></div>
            <div>
                <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Category Details</p>
                <p style="font-size:12px; color:#94A3B8; margin:0;">Edit the selected category.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="name">Name <span style="color:#EF4444;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $productCategory->name) }}" required class="field-input {{ $errors->has('name') ? 'error' : '' }}" placeholder="Category name">
                @if($errors->has('name'))
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="description">Description</label>
                <textarea name="description" id="description" class="field-textarea" placeholder="Write a short description...">{{ old('description', $productCategory->description) }}</textarea>
                @error('description')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="field-input">
                @if($productCategory->getFirstMediaUrl('image'))
                    <img id="preview-image" class="image-preview" src="{{ $productCategory->getFirstMediaUrl('image') }}" alt="Category image">
                @else
                    <img id="preview-image" class="image-preview" style="display:none;" src="" alt="Preview">
                @endif
                @error('image')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="field-group">
                    <label class="field-label" for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $productCategory->sort_order) }}" class="field-input" placeholder="0">
                    @error('sort_order')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                </div>
                <div style="display:flex; align-items:center; padding-top:28px;">
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="status" value="1" {{ old('status', $productCategory->status) ? 'checked' : '' }} style="width:auto; margin:0; border:none; background:transparent;">
                        <span style="font-size:13px; color:#374151;">Active</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; gap:12px; flex-wrap:wrap;">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Update Category</button>
        <a href="{{ route('admin.product-categories.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
@parent
<script>
$(function () {
    $('#image').on('change', function () {
        const [file] = this.files;
        if (!file) {
            return;
        }
        $('#preview-image').attr('src', URL.createObjectURL(file)).show();
    });
});
</script>
@endsection
