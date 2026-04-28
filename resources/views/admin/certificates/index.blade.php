@extends('layouts.admin')
@section('page-title', 'Certificates')

@section('styles')
<style>
.page-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; text-decoration:none; }
.btn-primary:hover { opacity:.9; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1px solid #E2E8F0; text-decoration:none; }
.status-pill { display:inline-flex; align-items:center; justify-content:center; padding:5px 12px; border-radius:999px; font-size:12px; font-weight:700; }
.image-thumb { width:48px; height:48px; object-fit:cover; border-radius:12px; border:1px solid #E2E8F0; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Certificates</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Manage certificates and their images.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i>
        Add Certificate
    </a>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:14px; margin-bottom:24px;">
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">Total certificates</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $certificates->total() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">Active</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $certificates->where('status', 1)->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div style="padding:18px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Certificate listings</p>
        <span style="font-size:12px; color:#94A3B8;">Showing {{ $certificates->count() }} of {{ $certificates->total() }}</span>
    </div>
    <div style="overflow-x:auto; padding:10px;">
        <table style="width:100%; border-collapse:collapse; min-width:720px;">
            <thead>
                <tr style="background:#F8FAFC; color:#475569; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Image</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Title</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Description</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Sort</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Status</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $certificate)
                <tr style="border-bottom:1px solid #F1F5F9;">
                    <td style="padding:14px 16px; vertical-align:middle;">
                        @if($certificate->image)
                            <img src="{{ $certificate->image->getUrl() }}" alt="Certificate image" class="image-thumb">
                        @else
                            <div style="width:48px; height:48px; border-radius:12px; background:#E2E8F0; display:flex; align-items:center; justify-content:center; color:#64748B; font-size:12px;">NO</div>
                        @endif
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#0F172A; font-weight:600;">{{ $certificate->title ?: 'Untitled' }}</td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $certificate->description ?: 'No description' }}</td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569;">{{ $certificate->sort_order }}</td>
                    <td style="padding:14px 16px; vertical-align:middle;">
                        <span class="status-pill" style="background:{{ $certificate->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $certificate->status ? '#15803D' : '#B91C1C' }};">{{ $certificate->status ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle; text-align:right;">
                        <a href="{{ route('admin.certificates.show', $certificate->id) }}" class="btn-ghost" style="margin-right:6px;">View</a>
                        <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="btn-ghost">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:18px 16px; color:#64748B; text-align:center;">No certificates found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:18px;">{{ $certificates->links() }}</div>
@endsection