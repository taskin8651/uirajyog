@extends('layouts.admin')
@section('page-title', 'Enquiries')

@section('styles')
<style>
.page-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; text-decoration:none; }
.btn-primary:hover { opacity:.9; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1px solid #E2E8F0; text-decoration:none; }
.status-pill { display:inline-flex; align-items:center; justify-content:center; padding:5px 12px; border-radius:999px; font-size:12px; font-weight:700; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Enquiries</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Review and manage customer enquiries from the website.</p>
    </div>
    <a href="{{ route('admin.enquiries.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i>
        New Enquiry
    </a>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:14px; margin-bottom:24px;">
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">Total enquiries</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $enquiries->total() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">Unread</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $enquiries->where('is_read', 0)->count() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">Completed</p>
        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">{{ $enquiries->where('status', 'completed')->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div style="padding:18px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Latest enquiries</p>
        <span style="font-size:12px; color:#94A3B8;">Showing {{ $enquiries->count() }} of {{ $enquiries->total() }}</span>
    </div>
    <div style="overflow-x:auto; padding:10px;">
        <table style="width:100%; border-collapse:collapse; min-width:900px;">
            <thead>
                <tr style="background:#F8FAFC; color:#475569; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">ID</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Name</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Product</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Email</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Status</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0;">Read</th>
                    <th style="padding:14px 16px; border-bottom:1px solid #E2E8F0; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enquiry)
                <tr style="border-bottom:1px solid #F1F5F9;">
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569;">#{{ $enquiry->id }}</td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#0F172A; font-weight:600;">{{ $enquiry->name }}</td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569;">{{ optional($enquiry->product)->name ?? 'General' }}</td>
                    <td style="padding:14px 16px; vertical-align:middle; color:#475569;">{{ $enquiry->email ?? '—' }}</td>
                    <td style="padding:14px 16px; vertical-align:middle;">
                        <span class="status-pill" style="background:{{ $enquiry->status === 'completed' ? '#DCFCE7' : ($enquiry->status === 'in_progress' ? '#DBEAFE' : ($enquiry->status === 'cancelled' ? '#FEE2E2' : '#FEF3C7')) }}; color:{{ $enquiry->status === 'completed' ? '#15803D' : ($enquiry->status === 'in_progress' ? '#1D4ED8' : ($enquiry->status === 'cancelled' ? '#B91C1C' : '#92400E')) }};">
                            {{ ucfirst(str_replace('_', ' ', $enquiry->status)) }}
                        </span>
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle;">
                        <span class="status-pill" style="background:{{ $enquiry->is_read ? '#E0F2FE' : '#F8FAFC' }}; color:{{ $enquiry->is_read ? '#0369A1' : '#475569' }};">
                            {{ $enquiry->is_read ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td style="padding:14px 16px; vertical-align:middle; text-align:right;">
                        <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="btn-ghost" style="margin-right:6px;">View</a>
                        <a href="{{ route('admin.enquiries.edit', $enquiry->id) }}" class="btn-ghost">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:18px 16px; color:#64748B; text-align:center;">No enquiries found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:18px;">{{ $enquiries->links() }}</div>
@endsection
