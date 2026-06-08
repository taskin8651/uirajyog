@extends('layouts.admin')
@section('page-title', 'Edit Blog')

@section('styles')
<style>
.form-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.form-card-header { padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.form-card-body { padding:22px; }
.field-label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.field-input, .field-textarea { width:100%; padding:10px 14px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:13.5px; color:#1E293B; background:#fff; outline:none; }
.field-input:focus, .field-textarea:focus { border-color:var(--accent); box-shadow:0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent); }
.field-textarea { min-height:130px; resize:vertical; }
.field-error { color:#EF4444; font-size:12px; margin-top:6px; display:flex; align-items:center; gap:6px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1.5px solid #E2E8F0; text-decoration:none; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.blogs.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to Blogs</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Edit Blog</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Update blog content and publishing status.</p>
    </div>
</div>

<form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-newspaper"></i>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Blog Content</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Edit title, summary, and full description.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div style="display:grid; gap:18px;">
                <div>
                    <label class="field-label" for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" class="field-input" required>
                    @error('title')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="short_description">Short Description</label>
                    <textarea name="short_description" id="short_description" class="field-textarea">{{ old('short_description', $blog->short_description) }}</textarea>
                    @error('short_description')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="description">Description</label>
                    <textarea name="description" id="description" class="field-textarea">{{ old('description', $blog->description) }}</textarea>
                    @error('description')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:start;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $blog->sort_order) }}" class="field-input">
                        @error('sort_order')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>

                    <div style="display:flex; align-items:center; gap:12px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $blog->status) ? 'checked' : '' }} style="width:auto;">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Update Blog</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
@parent
<script>
$(document).ready(function () {
    const element = document.querySelector('#description');

    if (element && typeof ClassicEditor !== 'undefined') {
        ClassicEditor.create(element).catch(function (error) {
            console.error('CKEditor error on #description', error);
        });
    }
});
</script>
@endsection
