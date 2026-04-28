@extends('layouts.admin')
@section('page-title', 'Enquiry Details')

@section('styles')
<style>
.detail-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.detail-header { padding:18px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; }
.detail-body { padding:22px; display:grid; gap:18px; }
.detail-row { display:flex; justify-content:space-between; gap:20px; flex-wrap:wrap; }
.detail-label { font-size:13px; font-weight:600; color:#475569; margin:0 0 6px; }
.detail-value { font-size:14px; color:#0F172A; margin:0; }
.badge { display:inline-flex; align-items:center; justify-content:center; padding:6px 12px; border-radius:999px; font-size:12px; font-weight:700; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.enquiries.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to enquiries</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Enquiry details</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Read the enquiry content and update status if needed.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('admin.enquiries.edit', $enquiry->id) }}" class="btn-primary">Edit</a>
        <a href="{{ route('admin.enquiries.index') }}" class="btn-ghost">Back</a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div>
            <p style="font-size:16px; font-weight:700; color:#0F172A; margin:0;">{{ $enquiry->subject ?: 'Enquiry #' . $enquiry->id }}</p>
            <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Submitted on {{ $enquiry->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <span class="badge" style="background:{{ $enquiry->is_read ? '#E0F2FE' : '#F8FAFC' }}; color:{{ $enquiry->is_read ? '#0369A1' : '#475569' }};">{{ $enquiry->is_read ? 'Read' : 'Unread' }}</span>
            <span class="badge" style="background:{{ $enquiry->status === 'completed' ? '#DCFCE7' : ($enquiry->status === 'in_progress' ? '#DBEAFE' : ($enquiry->status === 'cancelled' ? '#FEE2E2' : '#FEF3C7')) }}; color:{{ $enquiry->status === 'completed' ? '#15803D' : ($enquiry->status === 'in_progress' ? '#1D4ED8' : ($enquiry->status === 'cancelled' ? '#B91C1C' : '#92400E')) }};">{{ ucfirst(str_replace('_', ' ', $enquiry->status)) }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row">
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Name</p>
                <p class="detail-value">{{ $enquiry->name }}</p>
            </div>
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Email</p>
                <p class="detail-value">{{ $enquiry->email ?: '—' }}</p>
            </div>
        </div>
        <div class="detail-row">
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Phone</p>
                <p class="detail-value">{{ $enquiry->phone ?: '—' }}</p>
            </div>
            <div style="flex:1; min-width:220px;">
                <p class="detail-label">Product</p>
                <p class="detail-value">{{ optional($enquiry->product)->name ?? 'General' }}</p>
            </div>
        </div>
        <div>
            <p class="detail-label">Message</p>
            <p class="detail-value">{{ $enquiry->message ?: 'No message provided.' }}</p>
        </div>
        <div>
            <p class="detail-label">Admin Note</p>
            <p class="detail-value">{{ $enquiry->admin_note ?: 'No note added.' }}</p>
        </div>
    </div>
</div>
@endsection
