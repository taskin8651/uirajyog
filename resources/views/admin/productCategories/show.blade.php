@extends('layouts.admin')
@section('page-title', 'Category Details')

@section('styles')
<style>
.detail-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.detail-card-header { padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.detail-card-body { padding:22px; }
.detail-item { margin-bottom:18px; }
.detail-label { font-size:13px; font-weight:700; color:#475569; margin-bottom:6px; display:block; }
.detail-value { font-size:14px; color:#0F172A; }
.category-image { width:100%; max-width:320px; border-radius:14px; border:1px solid #E2E8F0; }
.status-badge { display:inline-flex; align-items:center; gap:6px; padding:7px 12px; border-radius:10px; font-size:12px; font-weight:600; }
.status-active { background:#ECFDF5; color:#166534; }
.status-inactive { background:#FEF2F2; color:#991B1B; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.product-categories.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to list</a>
        </div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Category Details</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">View category information in a clean admin layout.</p>
    </div>
    <a href="{{ route('admin.product-categories.edit', $productCategory->id) }}" class="btn-primary">Edit Category</a>
</div>

<div class="detail-card">
    <div class="detail-card-header">
        <div style="width:38px; height:38px; border-radius:11px; background:var(--accent-light); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:16px;"><i class="fas fa-tags"></i></div>
        <div>
            <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">{{ $productCategory->name }}</p>
            <p style="font-size:12px; color:#94A3B8; margin:2px 0 0;">Created at {{ $productCategory->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
    <div class="detail-card-body">
        <div class="detail-item">
            <span class="detail-label">Status</span>
            <span class="status-badge {{ $productCategory->status ? 'status-active' : 'status-inactive' }}">{{ $productCategory->status ? 'Active' : 'Inactive' }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Sort Order</span>
            <p class="detail-value">{{ $productCategory->sort_order }}</p>
        </div>
        <div class="detail-item">
            <span class="detail-label">Description</span>
            <p class="detail-value">{{ $productCategory->description ?? 'No description provided.' }}</p>
        </div>
        @if($productCategory->getFirstMediaUrl('image'))
        <div class="detail-item">
            <span class="detail-label">Image</span>
            <img src="{{ $productCategory->getFirstMediaUrl('image') }}" alt="Category image" class="category-image">
        </div>
        @endif
    </div>
</div>
@endsection
