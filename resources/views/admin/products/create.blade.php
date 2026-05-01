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
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-card-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background: var(--accent-light);
    color: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.form-card-body {
    padding: 22px;
}

.field-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

.field-label .req {
    color: #EF4444;
    margin-left: 2px;
}

.field-input,
.field-textarea,
.field-select {
    width: 100%;
    padding: 9px 13px;
    border: 1.5px solid #E2E8F0;
    border-radius: 9px;
    font-size: 13.5px;
    color: #1E293B;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    background: #fff;
    font-family: inherit;
}

.field-input:focus,
.field-textarea:focus,
.field-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
}

.field-textarea {
    min-height: 120px;
    resize: vertical;
}

.field-input.error,
.field-select.error,
.field-textarea.error {
    border-color: #EF4444;
}

.field-input.error:focus,
.field-textarea.error:focus,
.field-select.error:focus {
    box-shadow: 0 0 0 3px rgba(239,68,68,.15);
}

.field-hint {
    font-size: 12px;
    color: #94A3B8;
    margin-top: 5px;
}

.field-error {
    font-size: 12px;
    color: #EF4444;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 10px;
    background: var(--accent);
    color: #fff;
    font-size: 13.5px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: opacity .2s;
    font-family: inherit;
}

.btn-primary:hover {
    opacity: .88;
}

.btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    border-radius: 10px;
    background: #F8FAFC;
    color: #475569;
    font-size: 13.5px;
    font-weight: 600;
    border: 1.5px solid #E2E8F0;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s;
    font-family: inherit;
}

.btn-ghost:hover {
    background: #F1F5F9;
}

.image-preview {
    width: 100%;
    max-width: 220px;
    border-radius: 12px;
    margin-top: 12px;
    border: 1px solid #E2E8F0;
    background: #F8FAFC;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 14px;
    margin-top: 14px;
}

.gallery-item {
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    overflow: hidden;
    background: #F8FAFC;
}

.gallery-item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    display: block;
}

@media (max-width: 767px) {
    .responsive-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.products.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">
                ← Back to list
            </a>
        </div>

        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">
            Add Product
        </h2>

        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">
            Fill in the catalog details for the new product.
        </p>
    </div>
</div>

@if($errors->any())
    <div style="background:#FEE2E2; color:#B91C1C; padding:12px 16px; border-radius:12px; margin-bottom:18px; font-size:13px;">
        <strong>Please fix the following errors:</strong>

        <ul style="margin:8px 0 0;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-box-open"></i>
            </div>

            <div>
                <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">
                    Product Details
                </p>

                <p style="font-size:12px; color:#94A3B8; margin:0;">
                    Enter basic product information and media.
                </p>
            </div>
        </div>

        <div class="form-card-body">
            <div style="display:grid; gap:20px;">

                <div>
                    <label class="field-label" for="category_id">Category</label>

                    <select name="category_id" id="category_id" class="field-select {{ $errors->has('category_id') ? 'error' : '' }}">
                        @foreach($categories as $id => $label)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="name">
                        Name <span class="req">*</span>
                    </label>

                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        required 
                        class="field-input {{ $errors->has('name') ? 'error' : '' }}" 
                        placeholder="Product name"
                    >

                    @error('name')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="short_description">Short Description</label>

                    <textarea 
                        name="short_description" 
                        id="short_description" 
                        class="field-textarea {{ $errors->has('short_description') ? 'error' : '' }}" 
                        placeholder="Short summary..."
                    >{{ old('short_description') }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="description">Description</label>

                    <textarea 
                        name="description" 
                        id="description" 
                        class="field-textarea {{ $errors->has('description') ? 'error' : '' }}" 
                        placeholder="Full description..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div style="display:grid; gap:20px;">
                    <div>
                        <label class="field-label" for="features">Features</label>

                        <textarea 
                            name="features" 
                            id="features" 
                            class="field-textarea {{ $errors->has('features') ? 'error' : '' }}" 
                            placeholder="Product features..."
                        >{{ old('features') }}</textarea>

                        @error('features')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="ingredients">Ingredients</label>

                        <textarea 
                            name="ingredients" 
                            id="ingredients" 
                            class="field-textarea {{ $errors->has('ingredients') ? 'error' : '' }}" 
                            placeholder="Ingredients list..."
                        >{{ old('ingredients') }}</textarea>

                        @error('ingredients')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="usage_instruction">Usage Instruction</label>

                        <textarea 
                            name="usage_instruction" 
                            id="usage_instruction" 
                            class="field-textarea {{ $errors->has('usage_instruction') ? 'error' : '' }}" 
                            placeholder="How to use..."
                        >{{ old('usage_instruction') }}</textarea>

                        @error('usage_instruction')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="responsive-grid" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); gap:20px;">
                    <div>
                        <label class="field-label" for="pack_size">Pack Size</label>

                        <input 
                            type="text" 
                            name="pack_size" 
                            id="pack_size" 
                            value="{{ old('pack_size') }}" 
                            class="field-input {{ $errors->has('pack_size') ? 'error' : '' }}" 
                            placeholder="e.g. 250g"
                        >

                        @error('pack_size')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="price">Price</label>

                        <input 
                            type="number" 
                            step="0.01" 
                            name="price" 
                            id="price" 
                            value="{{ old('price') }}" 
                            class="field-input {{ $errors->has('price') ? 'error' : '' }}" 
                            placeholder="0.00"
                        >

                        @error('price')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>

                        <input 
                            type="number" 
                            name="sort_order" 
                            id="sort_order" 
                            value="{{ old('sort_order', 0) }}" 
                            class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}" 
                            placeholder="0"
                        >

                        @error('sort_order')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div style="display:grid; gap:20px;">
                    <div>
                        <label class="field-label" for="image">Main Image</label>

                        <input 
                            type="file" 
                            name="image" 
                            id="image" 
                            accept="image/*" 
                            class="field-input {{ $errors->has('image') ? 'error' : '' }}"
                        >

                        <img 
                            id="preview-image" 
                            class="image-preview" 
                            style="display:none;" 
                            src="" 
                            alt="Preview"
                        >

                        @error('image')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="images">Gallery Images</label>

                        <input 
                            type="file" 
                            name="images[]" 
                            id="images" 
                            accept="image/*" 
                            multiple 
                            class="field-input {{ $errors->has('images') || $errors->has('images.*') ? 'error' : '' }}"
                        >

                        <p class="field-hint">
                            Upload multiple images for the product gallery.
                        </p>

                        <div id="gallery-preview" class="gallery-grid" style="display:none;"></div>

                        @error('images')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror

                        @error('images.*')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:20px; align-items:center;">
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input 
                            type="checkbox" 
                            name="status" 
                            value="1" 
                            {{ old('status', 1) ? 'checked' : '' }} 
                            style="width:auto; margin:0; border:none; background:transparent;"
                        >
                        <span style="font-size:13px; color:#374151;">Active</span>
                    </label>

                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input 
                            type="checkbox" 
                            name="is_featured" 
                            value="1" 
                            {{ old('is_featured') ? 'checked' : '' }} 
                            style="width:auto; margin:0; border:none; background:transparent;"
                        >
                        <span style="font-size:13px; color:#374151;">Featured</span>
                    </label>
                </div>

            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; gap:12px; flex-wrap:wrap;">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check" style="font-size:11px;"></i> Save Product
        </button>

        <a href="{{ route('admin.products.index') }}" class="btn-ghost">
            Cancel
        </a>
    </div>
</form>

@endsection

@section('scripts')
@parent

<script>
$(document).ready(function () {

    if ($('#category_id').length && $.fn.select2) {
        $('#category_id').select2({
            width: '100%',
            placeholder: 'Select category'
        });
    }

    function initClassicEditor(selector) {
        const element = document.querySelector(selector);

        if (!element) {
            return;
        }

        if (typeof ClassicEditor === 'undefined') {
            console.error('CKEditor not loaded. Please include CKEditor CDN in admin layout.');
            return;
        }

        if (element.dataset.editorInitialized === 'true') {
            return;
        }

        ClassicEditor
            .create(element)
            .then(function () {
                element.dataset.editorInitialized = 'true';
            })
            .catch(function (error) {
                console.error('CKEditor error on ' + selector, error);
            });
    }

    initClassicEditor('#description');
    initClassicEditor('#features');
    initClassicEditor('#ingredients');
    initClassicEditor('#usage_instruction');

    $('#image').on('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            $('#preview-image').hide().attr('src', '');
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            $(this).val('');
            $('#preview-image').hide().attr('src', '');
            return;
        }

        $('#preview-image')
            .attr('src', URL.createObjectURL(file))
            .show();
    });

    $('#images').on('change', function () {
        const files = Array.from(this.files || []);
        const previewBox = $('#gallery-preview');

        previewBox.html('');

        if (!files.length) {
            previewBox.hide();
            return;
        }

        files.forEach(function (file) {
            if (!file.type.startsWith('image/')) {
                return;
            }

            previewBox.append(
                '<div class="gallery-item">' +
                    '<img src="' + URL.createObjectURL(file) + '" alt="Gallery preview">' +
                '</div>'
            );
        });

        previewBox.show();
    });

});
</script>
@endsection