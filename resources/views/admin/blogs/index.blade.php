@extends('layouts.admin')
@section('page-title', 'Blogs')

@section('styles')
<style>
.page-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; text-decoration:none; }
.btn-primary:hover { opacity:.88; color:#fff; }
.btn-outline { display:inline-flex; align-items:center; gap:7px; padding:9px 16px; border-radius:10px; border:1.5px solid #E2E8F0; background:#fff; color:#475569; text-decoration:none; font-size:13px; font-weight:600; }
.btn-outline:hover { background:#F8FAFC; }
.status-badge { display:inline-flex; align-items:center; gap:6px; padding:7px 12px; border-radius:10px; font-size:12px; font-weight:700; }
.status-active { background:#ECFDF5; color:#166534; }
.status-inactive { background:#FEF2F2; color:#991B1B; }
table.dataTable thead th { background:#F8FAFC !important; color:#64748B !important; font-size:11px !important; font-weight:700 !important; text-transform:uppercase; letter-spacing:.06em; padding:12px 16px !important; border-bottom:1px solid #E2E8F0 !important; white-space:nowrap; }
table.dataTable tbody td { padding:13px 16px !important; border-bottom:1px solid #F1F5F9 !important; font-size:13.5px; }
table.dataTable tbody tr:hover td { background:#F8FAFC !important; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Blogs</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Manage frontend blog content.</p>
    </div>

    <a href="{{ route('admin.blogs.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i> Add Blog
    </a>
</div>

@if(session('success'))
    <div style="background:#DCFCE7; color:#15803D; padding:12px 16px; border-radius:12px; margin-bottom:18px; font-size:13px; font-weight:600;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="page-card">
    <div style="padding:16px 20px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Blog List</p>
        <span style="font-size:12px; color:#94A3B8;">Use actions to edit, view, or delete blogs.</span>
    </div>

    <div style="overflow-x:auto; padding:4px 10px;">
        <table class="min-w-full datatable datatable-Blog" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Sort Order</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr data-entry-id="{{ $blog->id }}">
                        <td></td>
                        <td style="color:#475569;">#{{ $blog->id }}</td>
                        <td style="color:#0F172A; font-weight:600;">{{ $blog->title }}</td>
                        <td><span class="status-badge {{ $blog->status ? 'status-active' : 'status-inactive' }}">{{ $blog->status ? 'Active' : 'Inactive' }}</span></td>
                        <td style="color:#475569;">{{ $blog->sort_order }}</td>
                        <td style="text-align:right; display:flex; justify-content:flex-end; gap:6px; flex-wrap:wrap;">
                            <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn-outline"><i class="fas fa-eye" style="font-size:11px;"></i> View</a>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn-outline"><i class="fas fa-pencil-alt" style="font-size:11px;"></i> Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn-outline" style="border-color:#FECACA; color:#991B1B; background:transparent;">
                                    <i class="fas fa-trash-alt" style="font-size:11px;"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(function () {
    $('.datatable-Blog:not(.ajaxTable)').DataTable({
        scrollX: true,
        pageLength: 25,
        ordering: false,
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endsection
