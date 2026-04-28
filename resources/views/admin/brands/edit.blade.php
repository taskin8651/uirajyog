@extends('layouts.admin')
@section('page-title', 'Edit Brand')

@section('styles')
<style>
.form-card { background: #fff; border-radius: 14px; border: 1px solid #E2E8F0; overflow: hidden; }
.form-card-header { padding: 16px 22px; border-bottom: 1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.form-card-body { padding:22px; }
.field-label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.field-input, .field-textarea, .field-select { width:100%; padding:10px 14px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:13.5px; color:#1E293B; background:#fff; outline:none; }
.field-input:focus, .field-textarea:focus, .field-select:focus { border-color: var(--accent); box-shadow:0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent); }
.field-textarea { min-height:120px; resize:vertical; }
.field-error { color:#EF4444; font-size:12px; margin-top:6px; display:flex; align-items:center; gap:6px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; }
.btn-primary:hover { opacity:.9; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1.5px solid #E2E8F0; text-decoration:none; }
.image-preview { width:100%; max-width:240px; border-radius:14px; margin-top:12px; border:1px solid #E2E8F0; }
.image-actions { display:flex; gap:10px; margin-top:10px; flex-wrap:wrap; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.brands.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to brands</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Edit Brand</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Update brand details and status.</p>
    </div>
</div>

<form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-briefcase"></i>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Brand details</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Make changes to the brand record below.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div style="display:grid; gap:18px;">
                <div>
                    <label class="field-label" for="name">Name <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" class="field-input">
                    @error('name')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="description">Description</label>
                    <textarea name="description" id="description" class="field-textarea">{{ old('description', $brand->description) }}</textarea>
                    @error('description')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="website_url">Website URL</label>
                    <input type="url" name="website_url" id="website_url" value="{{ old('website_url', $brand->website_url) }}" class="field-input" placeholder="https://example.com">
                    @error('website_url')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*" class="field-input">
                    <img id="preview-logo" class="image-preview" style="display:none;" src="" alt="Logo preview">
                    @if($brand->logo)
                        <div class="image-actions">
                            <img src="{{ $brand->logo->getUrl() }}" alt="Current logo" class="image-preview">
                            <form action="{{ route('admin.brands.logo.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">Remove logo</button>
                            </form>
                        </div>
                    @endif
                    @error('logo')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:start;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $brand->sort_order) }}" class="field-input">
                        @error('sort_order')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                    <div style="display:flex; align-items:center; gap:12px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $brand->status) ? 'checked' : '' }} style="width:auto;">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Update Brand</button>
        <a href="{{ route('admin.brands.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
@parent
<script>
$(function() {
    $('#logo').on('change', function() {
        const [file] = this.files;
        if (!file) {
            $('#preview-logo').hide();
            return;
        }
        $('#preview-logo').attr('src', URL.createObjectURL(file)).show();
    });
});
</script>
@endsection
