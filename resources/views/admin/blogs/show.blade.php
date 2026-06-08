@extends('layouts.admin')
@section('page-title', 'Blog Details')

@section('styles')
<style>
.detail-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.detail-card-header { padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.detail-card-body { padding:22px; }
.detail-item { margin-bottom:18px; }
.detail-label { display:block; font-size:13px; font-weight:700; color:#475569; margin-bottom:6px; }
.detail-value { font-size:14px; color:#0F172A; }
.status-badge { display:inline-flex; align-items:center; gap:6px; padding:7px 12px; border-radius:10px; font-size:12px; font-weight:600; }
.status-active { background:#ECFDF5; color:#166534; }
.status-inactive { background:#FEF2F2; color:#991B1B; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; font-size:13.5px; font-weight:600; border:none; text-decoration:none; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.blogs.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to Blogs</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Blog Details</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Review blog content from the admin panel.</p>
    </div>
    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn-primary">Edit Blog</a>
</div>

<div class="detail-card">
    <div class="detail-card-header">
        <div style="width:38px; height:38px; border-radius:11px; background:var(--accent-light); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:16px;">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">{{ $blog->title }}</p>
            <p style="font-size:12px; color:#94A3B8; margin:2px 0 0;">Slug: {{ $blog->slug }}</p>
        </div>
    </div>

    <div class="detail-card-body">
        <div class="detail-item">
            <span class="detail-label">Status</span>
            <span class="status-badge {{ $blog->status ? 'status-active' : 'status-inactive' }}">{{ $blog->status ? 'Active' : 'Inactive' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Short Description</span>
            <p class="detail-value">{{ $blog->short_description ?? 'No short description provided.' }}</p>
        </div>

        <div class="detail-item">
            <span class="detail-label">Description</span>
            <div class="detail-value">{!! $blog->description ?? 'No description available.' !!}</div>
        </div>
    </div>
</div>
@endsection
