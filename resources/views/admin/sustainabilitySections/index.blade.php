@extends('layouts.admin')
@section('page-title', 'Sustainability Sections')

@section('styles')
<style>
.page-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; text-decoration:none; }
.btn-primary:hover { opacity:.9; color:#fff; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1px solid #E2E8F0; text-decoration:none; }
.status-pill { display:inline-flex; align-items:center; justify-content:center; padding:5px 12px; border-radius:999px; font-size:12px; font-weight:700; }
.thumb-img { width:76px; height:56px; object-fit:cover; border-radius:10px; border:1px solid #E2E8F0; background:#F8FAFC; }
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">
            Sustainability Sections
        </h2>

        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">
            Manage sustainability title, description and image sections.
        </p>
    </div>

    <a href="{{ route('admin.sustainability-sections.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i>
        Add Section
    </a>
</div>

@if(session('success'))
    <div style="background:#DCFCE7; color:#15803D; padding:12px 16px; border-radius:12px; margin-bottom:18px; font-size:13px; font-weight:600;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:14px; margin-bottom:24px;">
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">
            Total Sections
        </p>

        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">
            {{ $sustainabilitySections->total() }}
        </p>
    </div>

    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; margin:0 0 8px;">
            Active
        </p>

        <p style="font-size:26px; font-weight:700; color:#0F172A; margin:0;">
            {{ $sustainabilitySections->where('status', 1)->count() }}
        </p>
    </div>
</div>

<div class="page-card">
    <div style="padding:18px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">
            Sustainability listings
        </p>

        <span style="font-size:12px; color:#94A3B8;">
            Showing {{ $sustainabilitySections->count() }} of {{ $sustainabilitySections->total() }}
        </span>
    </div>

    <div style="overflow-x:auto; padding:10px;">
        <table style="width:100%; border-collapse:collapse; min-width:900px;">
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
                @forelse($sustainabilitySections as $section)
                    <tr style="border-bottom:1px solid #F1F5F9;">
                        <td style="padding:14px 16px; vertical-align:middle;">
                            @if($section->image)
                                <img 
                                    src="{{ $section->image->getUrl() }}" 
                                    alt="{{ $section->title }}" 
                                    class="thumb-img"
                                >
                            @else
                                <span style="font-size:12px; color:#94A3B8;">No image</span>
                            @endif
                        </td>

                        <td style="padding:14px 16px; vertical-align:middle; color:#0F172A; font-weight:600;">
                            {{ $section->title ?: 'No title' }}
                        </td>

                        <td style="padding:14px 16px; vertical-align:middle; color:#475569; max-width:360px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                            {{ $section->description ?: 'No description provided' }}
                        </td>

                        <td style="padding:14px 16px; vertical-align:middle; color:#475569;">
                            {{ $section->sort_order }}
                        </td>

                        <td style="padding:14px 16px; vertical-align:middle;">
                            <span class="status-pill" style="background:{{ $section->status ? '#DCFCE7' : '#FEE2E2' }}; color:{{ $section->status ? '#15803D' : '#B91C1C' }};">
                                {{ $section->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td style="padding:14px 16px; vertical-align:middle; text-align:right;">
                            <a href="{{ route('admin.sustainability-sections.show', $section->id) }}" class="btn-ghost" style="margin-right:6px;">
                                View
                            </a>

                            <a href="{{ route('admin.sustainability-sections.edit', $section->id) }}" class="btn-ghost">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:18px 16px; color:#64748B; text-align:center;">
                            No sustainability sections found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:18px;">
    {{ $sustainabilitySections->links() }}
</div>

@endsection