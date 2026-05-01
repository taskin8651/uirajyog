@extends('layouts.admin')
@section('page-title', 'Edit Product')

@section('styles')
<style>
.form-card {
    background:#fff;
    border-radius:14px;
    border:1px solid #E2E8F0;
    overflow:hidden;
}

.form-card-header {
    padding:16px 22px;
    border-bottom:1px solid #F1F5F9;
    display:flex;
    align-items:center;
    gap:10px;
}

.form-card-body {
    padding:22px;
}

.field-label {
    display:block;
    font-size:13px;
    font-weight:600;
    color:#374151;
    margin-bottom:6px;
}

.field-input,
.field-textarea,
.field-select {
    width:100%;
    padding:10px 14px;
    border:1.5px solid #E2E8F0;
    border-radius:10px;
    font-size:13.5px;
    color:#1E293B;
    background:#fff;
    outline:none;
}

.field-input:focus,
.field-textarea:focus,
.field-select:focus {
    border-color:var(--accent);
    box-shadow:0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
}

.field-textarea {
    min-height:120px;
    resize:vertical;
}

.field-error {
    color:#EF4444;
    font-size:12px;
    margin-top:6px;
    display:flex;
    align-items:center;
    gap:6px;
}

.field-hint {
    font-size:12px;
    color:#94A3B8;
    margin:8px 0 0;
}

.btn-primary {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 22px;
    border-radius:10px;
    background:var(--accent);
    color:#fff;
    border:none;
    font-size:13.5px;
    font-weight:600;
    cursor:pointer;
    text-decoration:none;
}

.btn-primary:hover {
    opacity:.9;
    color:#fff;
}

.btn-ghost {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    border-radius:10px;
    background:#F8FAFC;
    color:#475569;
    border:1.5px solid #E2E8F0;
    text-decoration:none;
    cursor:pointer;
}

.btn-ghost:hover {
    background:#F1F5F9;
    color:#334155;
}

.image-preview {
    width:100%;
    max-width:260px;
    border-radius:16px;
    margin-top:12px;
    border:1px solid #E2E8F0;
    background:#F8FAFC;
}

.gallery-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(130px, 1fr));
    gap:14px;
    margin-top:14px;
}

.gallery-item {
    position:relative;
    border:1px solid #E2E8F0;
    border-radius:14px;
    overflow:hidden;
    background:#F8FAFC;
}

.gallery-item img {
    width:100%;
    height:120px;
    object-fit:cover;
    display:block;
}

.gallery-empty {
    margin-top:10px;
    padding:14px;
    border:1px dashed #CBD5E1;
    border-radius:12px;
    color:#94A3B8;
    font-size:13px;
    background:#F8FAFC;
}

.delete-media-area {
    margin-top:16px;
    padding:16px;
    border:1px solid #E2E8F0;
    border-radius:14px;
    background:#fff;
}

.delete-media-title {
    font-size:13px;
    font-weight:700;
    color:#0F172A;
    margin:0 0 10px;
}

.delete-gallery-list {
    display:flex;
    flex-wrap:wrap;
    gap:10px;
}

@media (max-width: 767px) {
    .two-col {
        grid-template-columns:1fr !important;
    }
}
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.products.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">
            ← Back to products
        </a>

        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">
            Edit Product
        </h2>

        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">
            Update product details, main image and gallery images.
        </p>
    </div>
</div>

@if(session('success'))
    <div style="background:#DCFCE7; color:#15803D; padding:12px 16px; border-radius:12px; margin-bottom:18px; font-size:13px; font-weight:600;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

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

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-box"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">
                    Product Information
                </p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">
                    Edit product content and media.
                </p>
            </div>
        </div>

        <div class="form-card-body">
            <div style="display:grid; gap:18px;">

                <div class="two-col" style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                    <div>
                        <label class="field-label" for="category_id">Category</label>

                       <select name="category_id" id="category_id" class="field-select">
    @foreach($categories as $id => $name)
        <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>

                        @error('category_id')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="name">Product Name</label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            class="field-input"
                        >

                        @error('name')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="field-label" for="slug">Slug</label>

                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug', $product->slug) }}"
                        class="field-input"
                    >

                    @error('slug')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="short_description">Short Description</label>

                    <textarea
                        name="short_description"
                        id="short_description"
                        class="field-textarea"
                        style="min-height:80px;"
                    >{{ old('short_description', $product->short_description) }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="description">Description</label>

                    <textarea
                        name="description"
                        id="description"
                        class="field-textarea"
                    >{{ old('description', $product->description) }}</textarea>

                    @error('description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="features">Features</label>

                    <textarea
                        name="features"
                        id="features"
                        class="field-textarea"
                    >{{ old('features', $product->features) }}</textarea>

                    @error('features')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="ingredients">Ingredients</label>

                    <textarea
                        name="ingredients"
                        id="ingredients"
                        class="field-textarea"
                    >{{ old('ingredients', $product->ingredients) }}</textarea>

                    @error('ingredients')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="usage_instruction">Usage Instruction</label>

                    <textarea
                        name="usage_instruction"
                        id="usage_instruction"
                        class="field-textarea"
                    >{{ old('usage_instruction', $product->usage_instruction) }}</textarea>

                    @error('usage_instruction')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="two-col" style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                    <div>
                        <label class="field-label" for="pack_size">Pack Size</label>

                        <input
                            type="text"
                            name="pack_size"
                            id="pack_size"
                            value="{{ old('pack_size', $product->pack_size) }}"
                            class="field-input"
                        >

                        @error('pack_size')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
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
                            value="{{ old('price', $product->price) }}"
                            class="field-input"
                        >

                        @error('price')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="field-label" for="image">Main Image</label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="field-input"
                    >

                    <img
                        id="preview-image"
                        class="image-preview"
                        src="{{ $product->image ? $product->image->getUrl() : '' }}"
                        alt="Main image preview"
                        style="{{ $product->image ? '' : 'display:none;' }}"
                    >

                    @if($product->image)
                        <div style="margin-top:10px;">
                            <a href="{{ $product->image->getUrl() }}" target="_blank" class="btn-ghost">
                                <i class="fas fa-eye"></i> View Main Image
                            </a>
                        </div>
                    @endif

                    @error('image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
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
                        class="field-input"
                    >

                    <p class="field-hint">
                        You can upload multiple gallery images.
                    </p>

                    <div id="gallery-preview" class="gallery-grid" style="display:none;"></div>

                    @if($product->images && $product->images->count())
                        <div class="gallery-grid">
                            @foreach($product->images as $media)
                                <div class="gallery-item">
                                    <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="gallery-empty">
                            No gallery images uploaded yet.
                        </div>
                    @endif

                    @error('images')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror

                    @error('images.*')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="two-col" style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:start;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>

                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            value="{{ old('sort_order', $product->sort_order) }}"
                            class="field-input"
                        >

                        @error('sort_order')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div style="display:flex; align-items:center; gap:18px; padding-top:24px; flex-wrap:wrap;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input
                                type="checkbox"
                                name="status"
                                value="1"
                                {{ old('status', $product->status) ? 'checked' : '' }}
                                style="width:auto;"
                            >
                            Active
                        </label>

                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                style="width:auto;"
                            >
                            Featured
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Update Product
        </button>

        <a href="{{ route('admin.products.index') }}" class="btn-ghost">
            Cancel
        </a>
    </div>
</form>

@if($product->image)
    <form
        action="{{ route('admin.products.image.destroy', $product->id) }}"
        method="POST"
        style="margin-top:12px;"
        onsubmit="return confirm('Are you sure you want to remove main image?')"
    >
        @csrf
        @method('DELETE')

        <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
            <i class="fas fa-trash"></i> Remove Main Image
        </button>
    </form>
@endif

@if($product->images && $product->images->count())
    <div class="delete-media-area">
        <p class="delete-media-title">
            Delete Gallery Images
        </p>

        <div class="delete-gallery-list">
            @foreach($product->images as $media)
                <form
                    action="{{ route('admin.products.gallery.destroy', [$product->id, $media->id]) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to remove this gallery image?')"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
                        <i class="fas fa-trash"></i> Remove Image {{ $loop->iteration }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>
@endif

@endsection

@section('scripts')
@parent

<script>
$(document).ready(function () {

    /* Select2 */
    if ($('#category_id').length && $.fn.select2) {
        $('#category_id').select2({
            width: '100%',
            placeholder: 'Select category'
        });
    }

    /* CKEditor */
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

    /* Main image preview */
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

    /* Gallery images preview */
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

            const imageUrl = URL.createObjectURL(file);

            previewBox.append(
                '<div class="gallery-item">' +
                    '<img src="' + imageUrl + '" alt="Gallery preview">' +
                '</div>'
            );
        });

        previewBox.show();
    });

});
</script>
@endsection