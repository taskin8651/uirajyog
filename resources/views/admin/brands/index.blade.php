@extends('layouts.admin')
@section('page-title', 'Brands')

@section('styles')
<style>
.page-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #E2E8F0;
    overflow: hidden;
}
.btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 20px; border-radius: 10px;
    background: var(--accent); color: #fff;
    font-size: 13.5px; font-weight: 600; border: none;
    cursor: pointer; text-decoration: none;
    transition: opacity .2s;
}
.btn-primary:hover { opacity: .9; }
.btn-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 18px; border-radius: 10px;
    background: #F8FAFC; color: #475569;
    font-size: 13.5px; font-weight: 600; border: 1px solid #E2E8F0;
    text-decoration: none; transition: background .2s;
}
.btn-ghost:hover { background: #F1F5F9; }
.status-pill {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 5px 10px; border-radius: 999px;
    font-size: 12px; font-weight: 700;
}
.image-thumb {
    width: 42px; height: 42px; border-radius: 12px;
    object-fit: cover; border: 1px solid #E2E8F0;
}
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Brands</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Manage brand partners, logos, and listing order for the site.</p>
    </div>
    <a href="{{ route('admin.brands.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i>
        Add Brand
    </a>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:14px; margin-bottom:24px;">
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.06em; margin:0 0 8px;">Total Brands</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $brands->total() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.06em; margin:0 0 8px;">Active</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $brands->where('status', 1)->count() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.06em; margin:0 0 8px;">Inactive</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $brands->where('status', 0)->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div style="padding:18px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Brand listings</p>
        <span style="font-size:12px; color:#94A3B8;">Showing {{ $brands->count() }} of {{ $brands->total() }}</span>
    </div>
    <div style="overflow-x:auto; padding:10px;">
        <table style="width:100%; border-collapse:collapse; min-width:760px;">
            <thead>
                <tr style="background:#F8FAFC; color:#475569; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Logo</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Name</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Website</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Sort</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Status</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                <tr style="border-bottom:1px solid #F1F5F9;">
                    <td style="padding:14px 16px; vertical-align:middle;">
                        @if($brand->logo)
                            <img src="{{ $brand->logo->getUrl() }}" alt="{{ $brand->name }}" class="image-thumb">
                        @else
                            <div style="width:42px; height:42px; border-radius:12px; background:#E2E8F0; display:flex; align-items:center; justify-content:center; color:#64748B; font-size:12px;">NO</div>
                        @endif
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#1E293B; font-weight:600;">{{ $brand->name }}</td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569;">
                        @if($brand->website_url)
                            <a href="{{ $brand->website_url }}" target="_blank" style="color:var(--accent); text-decoration:none;">Visit</a>
                        @else
                            —
                        @endif
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569;">{{ $brand->sort_order }}</td>
                    <td style="padding:14px 16px; vertical-align:middle;">
                        <span class="status-pill" style="background:{{ $brand->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $brand->status ? '#15803D' : '#B91C1C' }};">
                            {{ $brand->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle; text-align:right;">
                        <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn-ghost" style="margin-right:6px;">View</a>
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn-ghost" style="margin-right:6px;">Edit</a>
                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-ghost" style="color:#BE123C; border-color:#FECACA;">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:18px 16px; color:#64748B; text-align:center;">No brands found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:18px;">{{ $brands->links() }}</div>
@endsection
