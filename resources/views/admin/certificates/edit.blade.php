@extends('layouts.admin')
@section('page-title', 'Edit Certificate')

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
        <a href="{{ route('admin.certificates.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to certificates</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Edit Certificate</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Update the certificate content and PDF file.</p>
    </div>
</div>

<form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-certificate"></i>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Certificate content</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Edit the certificate details and PDF.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div style="display:grid; gap:18px;">
                <div>
                    <label class="field-label" for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $certificate->title) }}" class="field-input">
                    @error('title')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="field-label" for="short_description">Short Description</label>
                    <textarea name="short_description" id="short_description" class="field-textarea" style="min-height:80px;">{{ old('short_description', $certificate->short_description) }}</textarea>
                    @error('short_description')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
                <div>
    <label class="field-label" for="pdf">PDF / Image File</label>

    <input 
        type="file" 
        name="pdf" 
        id="pdf" 
        accept="application/pdf,image/*" 
        class="field-input"
    >

    <div id="file-preview-wrap" style="margin-top:12px; display:none;">
        <p id="pdf-info" style="font-size:12px; color:#64748B; margin-bottom:8px;">
            <i id="file-icon" class="fas fa-file" style="margin-right:6px;"></i>
            <span id="pdf-name"></span>
        </p>

        <img 
            id="image-preview" 
            src="" 
            alt="Image Preview" 
            style="max-width:220px; border-radius:12px; border:1px solid #E2E8F0; display:none;"
        >
    </div>

    @if($certificate->pdf)
        @php
            $file = $certificate->pdf;
            $mimeType = $file->mime_type ?? '';
            $isImage = str_starts_with($mimeType, 'image/');
            $isPdf = $mimeType === 'application/pdf';
        @endphp

        <div class="image-actions" style="margin-top:12px;">
            @if($isImage)
                <div style="margin-bottom:10px;">
                    <img 
                        src="{{ $file->getUrl() }}" 
                        alt="{{ $certificate->title }}" 
                        style="max-width:220px; border-radius:12px; border:1px solid #E2E8F0;"
                    >
                </div>

                <a href="{{ $file->getUrl() }}" target="_blank" class="btn-ghost" style="margin-right:6px;">
                    <i class="fas fa-image" style="color:#10B981;"></i> View Image
                </a>
            @elseif($isPdf)
                <a href="{{ $file->getUrl() }}" target="_blank" class="btn-ghost" style="margin-right:6px;">
                    <i class="fas fa-file-pdf" style="color:#EF4444;"></i> View PDF
                </a>
            @else
                <a href="{{ $file->getUrl() }}" target="_blank" class="btn-ghost" style="margin-right:6px;">
                    <i class="fas fa-file"></i> View File
                </a>
            @endif

            <form 
                action="{{ route('admin.certificates.destroyPdf', $certificate->id) }}" 
                method="POST" 
                style="display:inline-block;"
                onsubmit="return confirm('Are you sure you want to remove this file?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
                    Remove File
                </button>
            </form>
        </div>
    @endif

    @error('pdf')
        <p class="field-error">
            <i class="fas fa-exclamation-circle"></i>{{ $message }}
        </p>
    @enderror
</div>

<script>
$(function () {
    $('#pdf').on('change', function () {
        const file = this.files[0];

        if (!file) {
            $('#file-preview-wrap').hide();
            $('#image-preview').hide().attr('src', '');
            $('#pdf-name').text('');
            return;
        }

        $('#file-preview-wrap').show();
        $('#pdf-name').text(file.name);

        if (file.type === 'application/pdf') {
            $('#file-icon')
                .attr('class', 'fas fa-file-pdf')
                .css('color', '#EF4444');

            $('#image-preview').hide().attr('src', '');
        } else if (file.type.startsWith('image/')) {
            $('#file-icon')
                .attr('class', 'fas fa-file-image')
                .css('color', '#10B981');

            $('#image-preview')
                .attr('src', URL.createObjectURL(file))
                .show();
        } else {
            $('#file-icon')
                .attr('class', 'fas fa-file')
                .css('color', '#64748B');

            $('#image-preview').hide().attr('src', '');
        }
    });
});
</script>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:start;">
                    <div>
                        <label class="field-label" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $certificate->sort_order) }}" class="field-input">
                        @error('sort_order')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                    <div style="display:flex; align-items:center; gap:12px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $certificate->status) ? 'checked' : '' }} style="width:auto;">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Update Certificate</button>
        <a href="{{ route('admin.certificates.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection

@section('scripts')
@parent
<script>
$(function() {
    $('#pdf').on('change', function() {
        const [file] = this.files;
        if (!file) { $('#pdf-info').hide(); return; }
        $('#pdf-name').text(file.name);
        $('#pdf-info').show();
    });
});
</script>
@endsection