@extends('layouts.admin')
@section('page-title', 'Product Details')

@section('styles')
<style>
.detail-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.detail-card-header { padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.detail-card-body { padding:22px; }
.detail-item { margin-bottom:18px; }
.detail-label { display:block; font-size:13px; font-weight:700; color:#475569; margin-bottom:6px; }
.detail-value { font-size:14px; color:#0F172A; }
.product-image { width:100%; max-width:320px; border-radius:14px; border:1px solid #E2E8F0; }
.gallery-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(140px,1fr)); gap:12px; margin-top:12px; }
.gallery-item { border:1px solid #E2E8F0; border-radius:12px; overflow:hidden; }
.gallery-item img { width:100%; display:block; }
.status-badge { display:inline-flex; align-items:center; gap:6px; padding:7px 12px; border-radius:10px; font-size:12px; font-weight:600; }
.status-active { background:#ECFDF5; color:#166534; }
.status-inactive { background:#FEF2F2; color:#991B1B; }
.featured-tag { display:inline-flex; align-items:center; padding:7px 12px; border-radius:10px; background:#EFF6FF; color:#1D4ED8; font-size:12px; font-weight:600; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <a href="{{ route('admin.products.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to list</a>
        </div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Product Details</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Review product content and media from the admin panel.</p>
    </div>
    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-primary">Edit Product</a>
</div>

<div class="detail-card">
    <div class="detail-card-header">
        <div style="width:38px; height:38px; border-radius:11px; background:var(--accent-light); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:16px;"><i class="fas fa-box-open"></i></div>
        <div>
            <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">{{ $product->name }}</p>
            <p style="font-size:12px; color:#94A3B8; margin:2px 0 0;">Category: {{ $product->category?->name ?? 'Unassigned' }}</p>
        </div>
    </div>
    <div class="detail-card-body">
        <div class="detail-item">
            <span class="detail-label">Status</span>
            <span class="status-badge {{ $product->status ? 'status-active' : 'status-inactive' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span>
            @if($product->is_featured)<span class="featured-tag">Featured</span>@endif
        </div>
        <div class="detail-item">
            <span class="detail-label">Price</span>
            <p class="detail-value">{{ $product->price ? '$' . number_format($product->price, 2) : 'Not priced' }}</p>
        </div>
        <div class="detail-item">
            <span class="detail-label">Short Description</span>
            <p class="detail-value">{{ $product->short_description ?? 'No short description provided.' }}</p>
        </div>
        <div class="detail-item">
            <span class="detail-label">Description</span>
            <p class="detail-value">{!! nl2br(e($product->description ?? 'No description available.')) !!}</p>
        </div>
        @if($product->getFirstMediaUrl('image'))
        <div class="detail-item">
            <span class="detail-label">Main Image</span>
            <img src="{{ $product->getFirstMediaUrl('image') }}" alt="Product image" class="product-image">
        </div>
        @endif
        @if($product->getMedia('images')->count())
        <div class="detail-item">
            <span class="detail-label">Gallery Images</span>
            <div class="gallery-grid">
                @foreach($product->getMedia('images') as $media)
                    <div class="gallery-item"><img src="{{ $media->getUrl() }}" alt="Gallery image"></div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection