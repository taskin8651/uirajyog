@extends('layouts.admin')
@section('page-title', 'Category Details')

@section('styles')
<style>
.detail-card { background: #fff; border-radius: 14px; border: 1px solid #E2E8F0; overflow: hidden; }
.detail-row { display: flex; gap: 12px; padding: 14px 0; border-bottom: 1px solid #F1F5F9; align-items: flex-start; }
.detail-row:last-child { border-bottom: none; }
.detail-label { width: 160px; flex-shrink: 0; font-size: 12px; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: .05em; padding-top: 2px; }
.detail-value { font-size: 14px; color: #1E293B; font-weight: 500; }
.role-tag { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; background: var(--accent-light); color: var(--accent); border: 1px solid color-mix(in srgb, var(--accent) 20%, transparent); }
.btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 10px; background: var(--accent); color: #fff; font-size: 13px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; transition: opacity .2s; }
.btn-primary:hover { opacity: .88; color: #fff; }
.btn-outline { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 10px; background: #fff; color: #475569; font-size: 13px; font-weight: 600; text-decoration: none; border: 1.5px solid #E2E8F0; transition: background .15s; }
.btn-outline:hover { background: #F8FAFC; color: #374151; }
.category-image { width: 100%; max-width: 320px; border-radius: 14px; border: 1px solid #E2E8F0; }
.status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 7px 12px; border-radius: 10px; font-size: 12px; font-weight: 600; }
.status-active { background: #ECFDF5; color: #166534; }
.status-inactive { background: #FEF2F2; color: #991B1B; }
.featured-tag { display: inline-flex; align-items: center; padding: 7px 12px; border-radius: 10px; background: #EFF6FF; color: #1D4ED8; font-size: 12px; font-weight: 600; }
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.product-categories.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to list</a>
        </div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Category Details</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Review category settings and metadata.</p>
    </div>
    <a href="{{ route('admin.product-categories.edit', $productCategory->id) }}" class="btn-primary"><i class="fas fa-pencil-alt" style="font-size:11px;"></i> Edit Category</a>
</div>

<div class="detail-card">
    <div style="padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px;">
        <div style="width:38px; height:38px; border-radius:11px; background:var(--accent-light); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:16px;"><i class="fas fa-tags"></i></div>
        <div>
            <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">{{ $productCategory->name }}</p>
            <p style="font-size:12px; color:#94A3B8; margin:2px 0 0;">Created at {{ optional($productCategory->created_at)->format('d M Y, H:i') }}</p>
        </div>
    </div>
    <div style="padding:22px;">
        <div class="detail-row">
            <span class="detail-label">Status</span>
            <span class="detail-value"><span class="status-badge {{ $productCategory->status ? 'status-active' : 'status-inactive' }}">{{ $productCategory->status ? 'Active' : 'Inactive' }}</span></span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Sort Order</span>
            <span class="detail-value">{{ $productCategory->sort_order }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Description</span>
            <span class="detail-value">{{ $productCategory->description ?? 'No description provided.' }}</span>
        </div>
        @if($productCategory->getFirstMediaUrl('image'))
        <div class="detail-row">
            <span class="detail-label">Image</span>
            <span class="detail-value"><img src="{{ $productCategory->getFirstMediaUrl('image') }}" alt="Category image" class="category-image"></span>
        </div>
        @endif
    </div>
</div>
@endsection
