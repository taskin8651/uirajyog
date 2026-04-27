@extends('layouts.admin')
@section('page-title', 'Product Categories')

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
    padding: 10px 22px; border-radius: 10px;
    background: var(--accent); color: #fff;
    font-size: 13.5px; font-weight: 600; border: none;
    text-decoration: none; cursor: pointer;
}
.btn-primary:hover { opacity: .88; }
.btn-outline {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px; border-radius: 10px;
    font-size: 13px; font-weight: 600; text-decoration: none;
    border: 1.5px solid #E2E8F0; background: #fff; color: #475569;
}
.btn-outline:hover { background: #F8FAFC; }
.status-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 12px; border-radius: 10px;
    font-size: 12px; font-weight: 700;
}
.status-active { background: #ECFDF5; color: #166534; }
.status-inactive { background: #FEF2F2; color: #991B1B; }

/* DataTable overrides */
table.dataTable thead th {
    background: #F8FAFC !important; color: #64748B !important;
    font-size: 11px !important; font-weight: 700 !important;
    text-transform: uppercase; letter-spacing: .06em;
    padding: 12px 16px !important; border-bottom: 1px solid #E2E8F0 !important;
    white-space: nowrap;
}
table.dataTable tbody td { padding: 13px 16px !important; border-bottom: 1px solid #F1F5F9 !important; font-size: 13.5px; }
table.dataTable tbody tr:hover td { background: #F8FAFC !important; }
table.dataTable tbody tr:last-child td { border-bottom: none !important; }
.dataTables_wrapper .dataTables_filter input {
    padding: 7px 12px 7px 34px !important; border-radius: 9px !important;
    border: 1px solid #E2E8F0 !important; font-size: 13px !important;
    background: #F8FAFC url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%239CA3AF' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E") no-repeat 10px center !important;
    outline: none !important;
}
.dataTables_wrapper .dataTables_filter input:focus { border-color: var(--accent) !important; background-color: #fff !important; }
.dataTables_wrapper .dataTables_filter label { font-size: 13px; color: #64748B; }
.dataTables_wrapper .dataTables_length select {
    padding: 6px 10px; border-radius: 8px; border: 1px solid #E2E8F0;
    font-size: 13px; background: #F8FAFC; color: #374151; outline: none;
}
.dataTables_wrapper .dataTables_info { font-size: 12px; color: #94A3B8; padding-top: 10px; }
.dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 7px !important; font-size: 12px !important; padding: 5px 10px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: var(--accent) !important; color: #fff !important; border-color: var(--accent) !important;
}
.dt-buttons .btn { border-radius: 8px !important; font-size: 12px !important; padding: 6px 12px !important; }
.btn-danger { background: #FFF1F2 !important; color: #BE123C !important; border: 1.5px solid #FECDD3 !important; }
</style>
@endsection

@section('content')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Product Categories</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Manage all product categories and metadata.</p>
    </div>

    <a href="{{ route('admin.product-categories.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i>
        Add Category
    </a>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px,1fr)); gap:14px; margin-bottom:24px;">
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:16px 18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.05em; margin:0 0 6px;">Total Categories</p>
        <p style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">{{ $productCategories->total() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:16px 18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.05em; margin:0 0 6px;">Active</p>
        <p style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">{{ $productCategories->where('status', 1)->count() }}</p>
    </div>
    <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; padding:16px 18px;">
        <p style="font-size:11px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:.05em; margin:0 0 6px;">Inactive</p>
        <p style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">{{ $productCategories->where('status', 0)->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div style="padding:16px 20px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">All Categories</p>
        <span style="font-size:12px; color:#94A3B8;">Sorted by recent updates.</span>
    </div>

    <div style="overflow-x:auto; padding:4px 10px;">
        <table class="min-w-full datatable datatable-ProductCategory" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Sort Order</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productCategories as $category)
                <tr data-entry-id="{{ $category->id }}" style="border-bottom:1px solid #F1F5F9;">
                    <td></td>
                    <td style="padding:14px 16px; color:#475569; font-size:13px;">#{{ $category->id }}</td>
                    <td style="padding:14px 16px; color:#0F172A; font-size:13px;">{{ $category->name }}</td>
                    <td style="padding:14px 16px;"><span class="status-badge {{ $category->status ? 'status-active' : 'status-inactive' }}">{{ $category->status ? 'Active' : 'Inactive' }}</span></td>
                    <td style="padding:14px 16px; color:#475569; font-size:13px;">{{ $category->sort_order }}</td>
                    <td style="padding:14px 16px; text-align:right; display:flex; justify-content:flex-end; gap:6px; flex-wrap:wrap;">
                        <a href="{{ route('admin.product-categories.show', $category->id) }}" class="btn-outline"><i class="fas fa-eye" style="font-size:11px;"></i> View</a>
                        <a href="{{ route('admin.product-categories.edit', $category->id) }}" class="btn-outline"><i class="fas fa-pencil-alt" style="font-size:11px;"></i> Edit</a>
                        <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                            @method('DELETE') @csrf
                            <button type="submit" class="btn-outline" style="border-color:#FECACA; color:#991B1B; background:transparent;" onmouseover="this.style.background='#FFF1F2'" onmouseout="this.style.background='transparent';"><i class="fas fa-trash-alt" style="font-size:11px;"></i> Delete</button>
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
    $('.datatable-ProductCategory:not(.ajaxTable)').DataTable({
        scrollX: true,
        pageLength: 25,
        ordering: false,
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endsection
