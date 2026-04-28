@extends('layouts.admin')
@section('page-title', 'Site Settings')

@section('styles')
<style>
.page-card {
    background:#fff;
    border-radius:14px;
    border:1px solid #E2E8F0;
    overflow:hidden;
}

.form-card {
    background:#fff;
    border-radius:14px;
    border:1px solid #E2E8F0;
    overflow:hidden;
    margin-bottom:22px;
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
.field-textarea {
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
.field-textarea:focus {
    border-color:var(--accent);
    box-shadow:0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
}

.field-textarea {
    min-height:90px;
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

.btn-primary {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 20px;
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
}

.btn-ghost {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    border-radius:10px;
    background:#F8FAFC;
    color:#475569;
    border:1px solid #E2E8F0;
    text-decoration:none;
    cursor:pointer;
}

.status-pill {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:5px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.image-preview {
    width:100%;
    max-width:220px;
    border-radius:14px;
    border:1px solid #E2E8F0;
    margin-top:10px;
    background:#F8FAFC;
}

.image-actions {
    display:flex;
    gap:10px;
    margin-top:10px;
    flex-wrap:wrap;
}

.settings-grid {
    display:grid;
    grid-template-columns:repeat(2, minmax(0,1fr));
    gap:18px;
}

@media(max-width:768px) {
    .settings-grid {
        grid-template-columns:1fr;
    }
}
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">
            Site Settings
        </h2>

        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">
            Manage website logo, contact details, social links and SEO information.
        </p>
    </div>

    <span class="status-pill" style="background:{{ $siteSetting->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $siteSetting->status ? '#15803D' : '#B91C1C' }};">
        {{ $siteSetting->status ? 'Active' : 'Inactive' }}
    </span>
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

<form action="{{ route('admin.site-settings.update', $siteSetting->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Basic Info -->
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-globe"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Basic Website Info</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Site name, title and tagline.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="settings-grid">
                <div>
                    <label class="field-label" for="site_name">Site Name</label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $siteSetting->site_name) }}" class="field-input">
                    @error('site_name')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="site_title">Site Title</label>
                    <input type="text" name="site_title" id="site_title" value="{{ old('site_title', $siteSetting->site_title) }}" class="field-input">
                    @error('site_title')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="grid-column:1/-1;">
                    <label class="field-label" for="tagline">Tagline</label>
                    <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $siteSetting->tagline) }}" class="field-input">
                    @error('tagline')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-phone"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Contact Details</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Phone, email, WhatsApp and address.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="settings-grid">
                <div>
                    <label class="field-label" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $siteSetting->email) }}" class="field-input">
                    @error('email')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $siteSetting->phone) }}" class="field-input">
                    @error('phone')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="alternate_phone">Alternate Phone</label>
                    <input type="text" name="alternate_phone" id="alternate_phone" value="{{ old('alternate_phone', $siteSetting->alternate_phone) }}" class="field-input">
                    @error('alternate_phone')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="whatsapp_number">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $siteSetting->whatsapp_number) }}" class="field-input">
                    @error('whatsapp_number')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="grid-column:1/-1;">
                    <label class="field-label" for="address">Address</label>
                    <textarea name="address" id="address" class="field-textarea">{{ old('address', $siteSetting->address) }}</textarea>
                    @error('address')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="grid-column:1/-1;">
                    <label class="field-label" for="map_url">Map URL</label>
                    <textarea name="map_url" id="map_url" class="field-textarea">{{ old('map_url', $siteSetting->map_url) }}</textarea>
                    @error('map_url')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Social Links -->
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-share-alt"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Social Media Links</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Facebook, Instagram, LinkedIn, YouTube and Twitter.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="settings-grid">
                <div>
                    <label class="field-label" for="facebook_url">Facebook URL</label>
                    <input type="text" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $siteSetting->facebook_url) }}" class="field-input">
                </div>

                <div>
                    <label class="field-label" for="instagram_url">Instagram URL</label>
                    <input type="text" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $siteSetting->instagram_url) }}" class="field-input">
                </div>

                <div>
                    <label class="field-label" for="twitter_url">Twitter URL</label>
                    <input type="text" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $siteSetting->twitter_url) }}" class="field-input">
                </div>

                <div>
                    <label class="field-label" for="linkedin_url">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $siteSetting->linkedin_url) }}" class="field-input">
                </div>

                <div style="grid-column:1/-1;">
                    <label class="field-label" for="youtube_url">YouTube URL</label>
                    <input type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $siteSetting->youtube_url) }}" class="field-input">
                </div>
            </div>
        </div>
    </div>

    <!-- SEO -->
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-search"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">SEO Settings</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Meta title, description and keywords.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div style="display:grid; gap:18px;">
                <div>
                    <label class="field-label" for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $siteSetting->meta_title) }}" class="field-input">
                </div>

                <div>
                    <label class="field-label" for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" class="field-textarea">{{ old('meta_description', $siteSetting->meta_description) }}</textarea>
                </div>

                <div>
                    <label class="field-label" for="meta_keywords">Meta Keywords</label>
                    <textarea name="meta_keywords" id="meta_keywords" class="field-textarea">{{ old('meta_keywords', $siteSetting->meta_keywords) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Images -->
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-image"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Logo & Icons</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Upload website logo, footer logo and favicon.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="settings-grid">
                <div>
                    <label class="field-label" for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*" class="field-input">

                    @if($siteSetting->logo)
                        <img src="{{ $siteSetting->logo->getUrl() }}" alt="Logo" class="image-preview">
                    @endif
                </div>

                <div>
                    <label class="field-label" for="footer_logo">Footer Logo</label>
                    <input type="file" name="footer_logo" id="footer_logo" accept="image/*" class="field-input">

                    @if($siteSetting->footer_logo)
                        <img src="{{ $siteSetting->footer_logo->getUrl() }}" alt="Footer Logo" class="image-preview">
                    @endif
                </div>

                <div>
                    <label class="field-label" for="favicon">Favicon</label>
                    <input type="file" name="favicon" id="favicon" accept="image/*" class="field-input">

                    @if($siteSetting->favicon)
                        <img src="{{ $siteSetting->favicon->getUrl() }}" alt="Favicon" class="image-preview" style="max-width:80px;">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Other -->
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-cog"></i>
            </div>

            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Other Settings</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Copyright and status.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="settings-grid">
                <div>
                    <label class="field-label" for="copyright_text">Copyright Text</label>
                    <input type="text" name="copyright_text" id="copyright_text" value="{{ old('copyright_text', $siteSetting->copyright_text) }}" class="field-input">
                </div>

                <div style="display:flex; align-items:center; gap:12px; padding-top:26px;">
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                        <input type="checkbox" name="status" value="1" {{ old('status', $siteSetting->status) ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Update Settings
        </button>
    </div>
</form>

@if($siteSetting->logo || $siteSetting->footer_logo || $siteSetting->favicon)
    <div style="margin-top:18px; display:flex; flex-wrap:wrap; gap:10px;">
        @if($siteSetting->logo)
            <form action="{{ route('admin.site-settings.logo.destroy', $siteSetting->id) }}" method="POST" onsubmit="return confirm('Remove logo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
                    Remove Logo
                </button>
            </form>
        @endif

        @if($siteSetting->footer_logo)
            <form action="{{ route('admin.site-settings.footer-logo.destroy', $siteSetting->id) }}" method="POST" onsubmit="return confirm('Remove footer logo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
                    Remove Footer Logo
                </button>
            </form>
        @endif

        @if($siteSetting->favicon)
            <form action="{{ route('admin.site-settings.favicon.destroy', $siteSetting->id) }}" method="POST" onsubmit="return confirm('Remove favicon?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">
                    Remove Favicon
                </button>
            </form>
        @endif
    </div>
@endif

@endsection