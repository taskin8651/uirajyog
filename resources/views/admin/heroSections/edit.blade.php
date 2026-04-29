@extends('layouts.admin')
@section('page-title', 'Edit Hero Section')

@section('styles')
<style>
.form-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.form-card-header { padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.form-card-body { padding:22px; }
.field-label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.field-input, .field-textarea, .field-select { width:100%; padding:10px 14px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:13.5px; color:#1E293B; background:#fff; outline:none; }
.field-input:focus, .field-textarea:focus, .field-select:focus { border-color: var(--accent); box-shadow:0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent); }
.field-textarea { min-height:120px; resize:vertical; }
.field-error { color:#EF4444; font-size:12px; margin-top:6px; display:flex; align-items:center; gap:6px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; text-decoration:none; }
.btn-primary:hover { opacity:.9; color:#fff; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1.5px solid #E2E8F0; text-decoration:none; cursor:pointer; }
.btn-ghost:hover { background:#F1F5F9; color:#334155; }
.image-preview { width:100%; max-width:260px; border-radius:16px; margin-top:12px; border:1px solid #E2E8F0; }
.image-actions { display:flex; gap:10px; margin-top:10px; flex-wrap:wrap; align-items:flex-start; }
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.hero-sections.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">
            ← Back to hero sections
        </a>

        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">
            Edit Hero Section
        </h2>

        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">
            Update the hero section content and image.
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

<form action="{{ route('admin.hero-sections.update', $heroSection->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-photo-video"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">
                    Hero section content
                </p>

                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">
                    Edit the homepage hero section.
                </p>
            </div>
        </div>

        <div class="form-card-body">
            <div style="display:grid; gap:18px;">

                <div>
                    <label class="field-label" for="title">Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', $heroSection->title) }}" 
                        class="field-input"
                    >

                    @error('title')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="field-label" for="subtitle">Subtitle</label>
                    <input 
                        type="text" 
                        name="subtitle" 
                        id="subtitle" 
                        value="{{ old('subtitle', $heroSection->subtitle) }}" 
                        class="field-input"
                    >

                    @error('subtitle')
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
                    >{{ old('description', $heroSection->description) }}</textarea>

                    @error('description')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                    <div>
                        <label class="field-label" for="button_text">Primary Button Text</label>
                        <input 
                            type="text" 
                            name="button_text" 
                            id="button_text" 
                            value="{{ old('button_text', $heroSection->button_text) }}" 
                            class="field-input"
                        >

                        @error('button_text')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="button_link">Primary Button Link</label>
                        <input 
                            type="text" 
                            name="button_link" 
                            id="button_link" 
                            value="{{ old('button_link', $heroSection->button_link) }}" 
                            class="field-input"
                        >

                        @error('button_link')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                    <div>
                        <label class="field-label" for="secondary_button_text">Secondary Button Text</label>
                        <input 
                            type="text" 
                            name="secondary_button_text" 
                            id="secondary_button_text" 
                            value="{{ old('secondary_button_text', $heroSection->secondary_button_text) }}" 
                            class="field-input"
                        >

                        @error('secondary_button_text')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="secondary_button_link">Secondary Button Link</label>
                        <input 
                            type="text" 
                            name="secondary_button_link" 
                            id="secondary_button_link" 
                            value="{{ old('secondary_button_link', $heroSection->secondary_button_link) }}" 
                            class="field-input"
                        >

                        @error('secondary_button_link')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="field-label" for="image">Image</label>

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
                        style="display:none;" 
                        src="" 
                        alt="Image preview"
                    >

                    @if($heroSection->image)
                        <div class="image-actions">
                            <img 
                                src="{{ $heroSection->image->getUrl() }}" 
                                alt="Current image" 
                                class="image-preview"
                            >
                        </div>
                    @endif

                    @error('image')
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:start;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>

                        <input 
                            type="number" 
                            name="sort_order" 
                            id="sort_order" 
                            value="{{ old('sort_order', $heroSection->sort_order) }}" 
                            class="field-input"
                        >

                        @error('sort_order')
                            <p class="field-error">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div style="display:flex; align-items:center; gap:12px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input 
                                type="checkbox" 
                                name="status" 
                                value="1" 
                                {{ old('status', $heroSection->status) ? 'checked' : '' }} 
                                style="width:auto;"
                            >
                            Active
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Update Hero Section
        </button>

        <a href="{{ route('admin.hero-sections.index') }}" class="btn-ghost">
            Cancel
        </a>
    </div>
</form>

@if($heroSection->image)
    <form 
        action="{{ route('admin.hero-sections.image.destroy', $heroSection->id) }}" 
        method="POST" 
        style="margin-top:12px;"
        onsubmit="return confirm('Are you sure you want to remove this image?')"
    >
        @csrf
        @method('DELETE')

        <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
            Remove image
        </button>
    </form>
@endif

@endsection

@section('scripts')
@parent
<script>
$(function() {
    $('#image').on('change', function() {
        const [file] = this.files;

        if (!file) {
            $('#preview-image').hide();
            return;
        }

        $('#preview-image').attr('src', URL.createObjectURL(file)).show();
    });
});
</script>
@endsection