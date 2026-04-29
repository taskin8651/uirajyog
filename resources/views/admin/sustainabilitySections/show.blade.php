@extends('layouts.admin')
@section('page-title', 'View Sustainability Section')

@section('styles')
<style>
.show-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.show-row { padding:16px 22px; border-bottom:1px solid #F1F5F9; }
.show-label { font-size:12px; color:#94A3B8; font-weight:700; text-transform:uppercase; margin-bottom:6px; }
.show-value { font-size:14px; color:#0F172A; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1px solid #E2E8F0; text-decoration:none; }
.status-pill { display:inline-flex; align-items:center; justify-content:center; padding:5px 12px; border-radius:999px; font-size:12px; font-weight:700; }
.show-image { width:100%; max-width:360px; border-radius:16px; border:1px solid #E2E8F0; }
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.sustainability-sections.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">
            ← Back to sustainability sections
        </a>

        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">
            View Sustainability Section
        </h2>
    </div>

    <a href="{{ route('admin.sustainability-sections.edit', $sustainabilitySection->id) }}" class="btn-ghost">
        Edit
    </a>
</div>

<div class="show-card">
    <div class="show-row">
        <div class="show-label">Image</div>

        <div class="show-value">
            @if($sustainabilitySection->image)
                <img 
                    src="{{ $sustainabilitySection->image->getUrl() }}" 
                    alt="{{ $sustainabilitySection->title }}" 
                    class="show-image"
                >
            @else
                No image uploaded
            @endif
        </div>
    </div>

    <div class="show-row">
        <div class="show-label">Title</div>
        <div class="show-value">{{ $sustainabilitySection->title ?: 'No title' }}</div>
    </div>

    <div class="show-row">
        <div class="show-label">Description</div>
        <div class="show-value">
            {!! nl2br(e($sustainabilitySection->description ?: 'No description provided')) !!}
        </div>
    </div>

    <div class="show-row">
        <div class="show-label">Sort Order</div>
        <div class="show-value">{{ $sustainabilitySection->sort_order }}</div>
    </div>

    <div class="show-row">
        <div class="show-label">Status</div>

        <span class="status-pill" style="background:{{ $sustainabilitySection->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $sustainabilitySection->status ? '#15803D' : '#B91C1C' }};">
            {{ $sustainabilitySection->status ? 'Active' : 'Inactive' }}
        </span>
    </div>
</div>

@endsection