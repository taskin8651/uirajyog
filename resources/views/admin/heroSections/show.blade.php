@extends('layouts.admin')
@section('page-title', 'Hero Section Details')

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
        <a href="{{ route('admin.hero-sections.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to hero sections</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Hero section details</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Review the hero section content and links.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('admin.hero-sections.edit', $heroSection->id) }}" class="btn-primary">Edit</a>
        <a href="{{ route('admin.hero-sections.index') }}" class="btn-ghost">Back</a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div>
            <p style="font-size:16px; font-weight:700; color:#0F172A; margin:0;">{{ $heroSection->title ?: 'Untitled hero section' }}</p>
            <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Created on {{ $heroSection->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="badge" style="background:{{ $heroSection->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $heroSection->status ? '#15803D' : '#B91C1C' }};">{{ $heroSection->status ? 'Active' : 'Inactive' }}</span>
    </div>
    <div class="detail-body">
        <div class="detail-row">
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Subtitle</p>
                <p class="detail-value">{{ $heroSection->subtitle ?: 'N/A' }}</p>
            </div>
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Sort Order</p>
                <p class="detail-value">{{ $heroSection->sort_order }}</p>
            </div>
        </div>
        <div>
            <p class="detail-label">Description</p>
            <p class="detail-value">{{ $heroSection->description ?: 'No description added.' }}</p>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
            <div>
                <p class="detail-label">Primary button</p>
                <p class="detail-value">{{ $heroSection->button_text ?: 'N/A' }}<br><span style="color:#64748B; font-size:13px;">{{ $heroSection->button_link ?: 'No link' }}</span></p>
            </div>
            <div>
                <p class="detail-label">Secondary button</p>
                <p class="detail-value">{{ $heroSection->secondary_button_text ?: 'N/A' }}<br><span style="color:#64748B; font-size:13px;">{{ $heroSection->secondary_button_link ?: 'No link' }}</span></p>
            </div>
        </div>
        <div>
            <p class="detail-label">Image</p>
            @if($heroSection->image)
                <img src="{{ $heroSection->image->getUrl() }}" alt="Hero section image" class="image-preview">
            @else
                <p class="detail-value">No image uploaded.</p>
            @endif
        </div>
    </div>
</div>
@endsection
