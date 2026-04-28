@extends('layouts.admin')
@section('page-title', 'Certificate Details')

@section('styles')
<style>
.detail-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.detail-header { padding:18px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; }
.detail-body { padding:22px; display:grid; gap:18px; }
.detail-row { display:flex; justify-content:space-between; gap:20px; flex-wrap:wrap; }
.detail-label { font-size:13px; font-weight:600; color:#475569; margin:0 0 6px; }
.detail-value { font-size:14px; color:#0F172A; margin:0; }
.badge { display:inline-flex; align-items:center; justify-content:center; padding:6px 12px; border-radius:999px; font-size:12px; font-weight:700; }
.image-preview { width:100%; max-width:320px; border-radius:16px; border:1px solid #E2E8F0; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.certificates.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to certificates</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Certificate details</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Review the certificate content and image.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="btn-primary">Edit</a>
        <a href="{{ route('admin.certificates.index') }}" class="btn-ghost">Back</a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div>
            <p style="font-size:16px; font-weight:700; color:#0F172A; margin:0;">{{ $certificate->title ?: 'Untitled certificate' }}</p>
            <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Created on {{ $certificate->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="badge" style="background:{{ $certificate->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $certificate->status ? '#15803D' : '#B91C1C' }};">{{ $certificate->status ? 'Active' : 'Inactive' }}</span>
    </div>
    <div class="detail-body">
        <div class="detail-row">
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Title</p>
                <p class="detail-value">{{ $certificate->title ?: 'N/A' }}</p>
            </div>
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Sort Order</p>
                <p class="detail-value">{{ $certificate->sort_order }}</p>
            </div>
        </div>
        <div>
            <p class="detail-label">Description</p>
            <p class="detail-value">{{ $certificate->description ?: 'No description provided.' }}</p>
        </div>
        <div>
            <p class="detail-label">Image</p>
            @if($certificate->image)
                <img src="{{ $certificate->image->getUrl() }}" alt="Certificate image" class="image-preview">
            @else
                <p class="detail-value">No image uploaded.</p>
            @endif
        </div>
    </div>
</div>
@endsection