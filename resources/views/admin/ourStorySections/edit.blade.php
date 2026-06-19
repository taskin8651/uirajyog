@extends('layouts.admin')

@section('page-title', 'Edit Our Story Section')

@section('styles')
@parent

<style>
    .form-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 22px;
        border-bottom: 1px solid #F1F5F9;
    }

    .form-card-body {
        padding: 22px;
    }

    .field-label {
        display: block;
        margin-bottom: 6px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .field-input,
    .field-textarea,
    .field-select {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        outline: none;
        background: #ffffff;
        color: #1E293B;
        font-size: 13.5px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .field-input:focus,
    .field-textarea:focus,
    .field-select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px color-mix(
            in srgb,
            var(--accent) 15%,
            transparent
        );
    }

    .field-textarea {
        min-height: 120px;
        resize: vertical;
        line-height: 1.7;
    }

    .field-textarea.description-field {
        min-height: 220px;
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 6px 0 0;
        color: #EF4444;
        font-size: 12px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 22px;
        border: none;
        border-radius: 10px;
        background: var(--accent);
        color: #ffffff;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: transform .2s ease, opacity .2s ease;
    }

    .btn-primary:hover {
        color: #ffffff;
        opacity: .92;
        transform: translateY(-1px);
    }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 18px;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        background: #F8FAFC;
        color: #475569;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s ease;
    }

    .btn-ghost:hover {
        border-color: #CBD5E1;
        background: #F1F5F9;
        color: #0F172A;
    }

    .btn-remove-image {
        border-color: #FECACA;
        background: #FFF1F2;
        color: #BE123C;
    }

    .btn-remove-image:hover {
        border-color: #FDA4AF;
        background: #FFE4E6;
        color: #9F1239;
    }

    .image-upload-box {
        padding: 16px;
        border: 1px dashed #CBD5E1;
        border-radius: 14px;
        background: #F8FAFC;
    }

    .image-preview {
        display: block;
        width: 100%;
        max-width: 300px;
        max-height: 260px;
        margin-top: 12px;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        background: #ffffff;
        object-fit: contain;
    }

    .current-image-card {
        display: flex;
        align-items: flex-start;
        gap: 18px;
        margin-top: 18px;
        padding: 16px;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        background: #ffffff;
    }

    .current-image-card .image-preview {
        width: 180px;
        height: 140px;
        margin: 0;
        flex-shrink: 0;
    }

    .current-image-info {
        flex: 1;
        min-width: 0;
    }

    .current-image-info h4 {
        margin: 0 0 5px;
        color: #0F172A;
        font-size: 14px;
        font-weight: 700;
    }

    .current-image-info p {
        margin: 0 0 14px;
        color: #64748B;
        font-size: 12.5px;
        line-height: 1.6;
    }

    .image-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .form-footer-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 20px;
    }

    .status-box {
        display: flex;
        align-items: center;
        min-height: 42px;
        padding-top: 24px;
    }

    .status-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .status-label input {
        width: 17px;
        height: 17px;
        margin: 0;
        accent-color: var(--accent);
        cursor: pointer;
    }

    @media (max-width: 767.98px) {
        .form-card-body {
            padding: 18px;
        }

        .two-column-grid {
            grid-template-columns: 1fr !important;
        }

        .status-box {
            padding-top: 0;
        }

        .current-image-card {
            flex-direction: column;
        }

        .current-image-card .image-preview {
            width: 100%;
            height: auto;
            max-width: 300px;
        }

        .form-footer-actions .btn-primary,
        .form-footer-actions .btn-ghost {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

{{-- Page heading --}}
<div style="
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:24px;
    flex-wrap:wrap;
    gap:12px;
">
    <div>
        <a
            href="{{ route('admin.our-story-sections.index') }}"
            style="
                color:var(--accent);
                font-size:13px;
                font-weight:600;
                text-decoration:none;
            "
        >
            <i class="fas fa-arrow-left" style="margin-right:5px;"></i>
            Back to Our Story Sections
        </a>

        <h2 style="
            margin:10px 0 0;
            color:#0F172A;
            font-size:22px;
            font-weight:700;
        ">
            Edit Our Story Section
        </h2>

        <p style="
            margin:6px 0 0;
            color:#64748B;
            font-size:13px;
        ">
            Update the Our Story section content and image.
        </p>
    </div>
</div>

{{-- Success message --}}
@if(session('success'))
    <div style="
        margin-bottom:18px;
        padding:13px 16px;
        border:1px solid #A7F3D0;
        border-radius:10px;
        background:#ECFDF5;
        color:#047857;
        font-size:13px;
        font-weight:600;
    ">
        <i class="fas fa-check-circle" style="margin-right:6px;"></i>
        {{ session('success') }}
    </div>
@endif

{{-- Update form --}}
<form
    action="{{ route('admin.our-story-sections.update', $ourStorySection->id) }}"
    method="POST"
    enctype="multipart/form-data"
    id="update-story-form"
>
    @csrf
    @method('PUT')

    <div class="form-card">

        {{-- Card header --}}
        <div class="form-card-header">
            <div style="
                display:flex;
                align-items:center;
                justify-content:center;
                width:36px;
                height:36px;
                border-radius:12px;
                background:var(--accent-light);
                color:var(--accent);
                font-size:16px;
                flex-shrink:0;
            ">
                <i class="fas fa-book-open"></i>
            </div>

            <div>
                <p style="
                    margin:0;
                    color:#0F172A;
                    font-size:14px;
                    font-weight:700;
                ">
                    Our Story Section Content
                </p>

                <p style="
                    margin:2px 0 0;
                    color:#94A3B8;
                    font-size:12px;
                ">
                    Edit section details, visibility and featured image.
                </p>
            </div>
        </div>

        {{-- Card body --}}
        <div class="form-card-body">
            <div style="display:grid; gap:18px;">

                {{-- Title --}}
                <div>
                    <label class="field-label" for="title">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $ourStorySection->title) }}"
                        class="field-input"
                        placeholder="Enter section title"
                    >

                    @error('title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Short description --}}
                <div>
                    <label class="field-label" for="short_description">
                        Short Description
                    </label>

                    <textarea
                        name="short_description"
                        id="short_description"
                        class="field-textarea"
                        placeholder="Enter a short introductory description"
                    >{{ old('short_description', $ourStorySection->short_description) }}</textarea>

                    @error('short_description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Full description --}}
                <div>
                    <label class="field-label" for="description">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        class="field-textarea description-field"
                        placeholder="Enter complete Our Story content"
                    >{{ old('description', $ourStorySection->description) }}</textarea>

                    @error('description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label class="field-label" for="image">
                        Featured Image
                    </label>

                    <div class="image-upload-box">
                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="field-input"
                        >

                        <p style="
                            margin:8px 0 0;
                            color:#94A3B8;
                            font-size:12px;
                        ">
                            Allowed formats: JPG, JPEG, PNG and WEBP.
                        </p>

                        {{-- Newly selected image preview --}}
                        <div id="new-image-preview-wrapper" style="display:none;">
                            <p style="
                                margin:14px 0 0;
                                color:#475569;
                                font-size:12px;
                                font-weight:600;
                            ">
                                New Image Preview
                            </p>

                            <img
                                id="preview-image"
                                class="image-preview"
                                src=""
                                alt="New image preview"
                            >
                        </div>
                    </div>

                    @error('image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- Current image --}}
                    @if($ourStorySection->image)
                        <div class="current-image-card">
                            <img
                                src="{{ $ourStorySection->image->getUrl() }}"
                                alt="{{ $ourStorySection->title ?? 'Current image' }}"
                                class="image-preview"
                            >

                            <div class="current-image-info">
                                <h4>Current Featured Image</h4>

                                <p>
                                    Upload a new image to replace this image or use
                                    the remove button to delete only the current image.
                                    Section content will remain safe.
                                </p>

                                <div class="image-actions">
                                    <button
                                        type="button"
                                        class="btn-ghost btn-remove-image"
                                        id="remove-image-button"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        Remove Image
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sort order and status --}}
                <div
                    class="two-column-grid"
                    style="
                        display:grid;
                        grid-template-columns:1fr 1fr;
                        gap:18px;
                        align-items:start;
                    "
                >
                    <div>
                        <label class="field-label" for="sort_order">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            min="0"
                            value="{{ old('sort_order', $ourStorySection->sort_order) }}"
                            class="field-input"
                            placeholder="0"
                        >

                        @error('sort_order')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="status-box">
                        <label class="status-label" for="status">
                            <input type="hidden" name="status" value="0">

                            <input
                                type="checkbox"
                                name="status"
                                id="status"
                                value="1"
                                {{ old('status', $ourStorySection->status) ? 'checked' : '' }}
                            >

                            Active Section
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Update actions --}}
    <div class="form-footer-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i>
            Update Section
        </button>

        <a
            href="{{ route('admin.our-story-sections.index') }}"
            class="btn-ghost"
        >
            <i class="fas fa-times"></i>
            Cancel
        </a>
    </div>
</form>

{{-- Separate image deletion form --}}
{{-- Important: It is outside the update form to prevent nested form issues --}}
@if($ourStorySection->image)
    <form
        action="{{ route('admin.our-story-sections.image.destroy', $ourStorySection->id) }}"
        method="POST"
        id="remove-image-form"
        style="display:none;"
    >
        @csrf
        @method('DELETE')
    </form>
@endif

@endsection

@section('scripts')
@parent

<script>
    $(function () {
        let previewUrl = null;

        /*
         * New image preview
         */
        $('#image').on('change', function () {
            const file = this.files && this.files[0]
                ? this.files[0]
                : null;

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            if (!file) {
                $('#preview-image').attr('src', '');
                $('#new-image-preview-wrapper').hide();
                return;
            }

            if (!file.type.startsWith('image/')) {
                alert('Please select a valid image file.');
                $(this).val('');
                $('#preview-image').attr('src', '');
                $('#new-image-preview-wrapper').hide();
                return;
            }

            previewUrl = URL.createObjectURL(file);

            $('#preview-image').attr('src', previewUrl);
            $('#new-image-preview-wrapper').show();
        });

        /*
         * Remove only current image
         */
        $('#remove-image-button').on('click', function () {
            const removeForm = document.getElementById('remove-image-form');

            if (!removeForm) {
                return;
            }

            const confirmed = confirm(
                'Are you sure you want to remove this image?\n\nOnly the image will be removed. Title, description and other section data will remain unchanged.'
            );

            if (confirmed) {
                removeForm.submit();
            }
        });
    });
</script>
@endsection