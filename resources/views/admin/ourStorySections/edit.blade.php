@extends('layouts.admin')
@section('page-title', 'Edit Our Story Section')

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
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1.5px solid #E2E8F0; text-decoration:none; }
.image-preview { width:100%; max-width:260px; border-radius:16px; margin-top:12px; border:1px solid #E2E8F0; }
.image-actions { display:flex; gap:10px; margin-top:10px; flex-wrap:wrap; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.our-story-sections.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to our story sections</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Edit Our Story Section</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Update the our story section content and image.</p>
    </div>
</div>

<form action="{{ route('admin.our-story-sections.update', $ourStorySection->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Our story section content</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Edit the our story section.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div style="display:grid; gap:18px;">
                <div>
                    <label class="field-label" for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $ourStorySection->title) }}" class="field-input">
                    @error('title')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
                    <div>
                        <label class="field-label" for="short_description">Short Description</label>
                        <textarea name="short_description" id="short_description" class="field-textarea">{{ old('short_description', $ourStorySection->short_description) }}</textarea>
                        @error('short_description')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                <div>
                    <label class="field-label" for="description">Description</label>
                    <textarea name="description" id="description" class="field-textarea">{{ old('description', $ourStorySection->description) }}</textarea>
                    @error('description')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="field-label" for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="field-input">
                    <img id="preview-image" class="image-preview" style="display:none;" src="" alt="Image preview">
                    @if($ourStorySection->image)
                        <div class="image-actions">
                            <img src="{{ $ourStorySection->image->getUrl() }}" alt="Current image" class="image-preview">
                            <form action="{{ route('admin.our-story-sections.image.destroy', $ourStorySection->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">Remove image</button>
                            </form>
                        </div>
                    @endif
                    @error('image')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:start;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $ourStorySection->sort_order) }}" class="field-input">
                        @error('sort_order')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                    <div style="display:flex; align-items:center; gap:12px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $ourStorySection->status) ? 'checked' : '' }} style="width:auto;">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Update Section</button>
        <a href="{{ route('admin.our-story-sections.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
@parent
<script>
$(function() {
    $('#image').on('change', function() {
        const [file] = this.files;
        if (!file) { $('#preview-image').hide(); return; }
        $('#preview-image').attr('src', URL.createObjectURL(file)).show();
    });
});
</script>
@endsection