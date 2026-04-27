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
    padding: 10px 20px; border-radius: 10px;
    background: var(--accent); color: #fff;
    font-size: 13px; font-weight: 600; border: none;
    text-decoration: none; cursor: pointer;
}
.btn-primary:hover { opacity: .88; }
.btn-outline {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 12px; border-radius: 9px;
    border: 1.5px solid #E2E8F0; background: #fff;
    color: #475569; text-decoration: none; font-size: 13px;
}
.btn-outline:hover { background: #F8FAFC; }
.status-badge {
    display: inline-flex; align-items:center; gap:6px;
    padding: 6px 10px; border-radius: 10px;
    font-size: 12px; font-weight: 600;
}
.status-active { background: #ECFDF5; color: #166534; }
.status-inactive { background: #FEF2F2; color: #991B1B; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Product Categories</h2>
        <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Manage all product category records in the admin panel.</p>
    </div>

    <a href="{{ route('admin.product-categories.create') }}" class="btn-primary">
        <i class="fas fa-plus" style="font-size:11px;"></i>
        Add Category
    </a>
</div>

<div class="page-card">
    <div style="padding:16px 20px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
        <p style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Category List</p>
        <span style="font-size:12px; color:#94A3B8;">Showing latest categories first</span>
    </div>

    <div style="overflow-x:auto; padding:10px;">
        <table class="min-w-full datatable" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="padding:12px 16px; text-align:left; color:#64748B; font-size:12px; text-transform:uppercase; letter-spacing:.06em;">ID</th>
                    <th style="padding:12px 16px; text-align:left; color:#64748B; font-size:12px;">Name</th>
                    <th style="padding:12px 16px; text-align:left; color:#64748B; font-size:12px;">Status</th>
                    <th style="padding:12px 16px; text-align:left; color:#64748B; font-size:12px;">Sort</th>
                    <th style="padding:12px 16px; text-align:right; color:#64748B; font-size:12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productCategories as $category)
                <tr style="border-bottom:1px solid #F1F5F9;">
                    <td style="padding:14px 16px; color:#475569; font-size:13px;">#{{ $category->id }}</td>
                    <td style="padding:14px 16px; color:#0F172A; font-size:13px;">{{ $category->name }}</td>
                    <td style="padding:14px 16px;">
                        <span class="status-badge {{ $category->status ? 'status-active' : 'status-inactive' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding:14px 16px; color:#475569; font-size:13px;">{{ $category->sort_order }}</td>
                    <td style="padding:14px 16px; text-align:right; display:flex; justify-content:flex-end; gap:6px; flex-wrap:wrap;">
                        <a href="{{ route('admin.product-categories.show', $category->id) }}" class="btn-outline">View</a>
                        <a href="{{ route('admin.product-categories.edit', $category->id) }}" class="btn-outline">Edit</a>
                        <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @method('DELETE') @csrf
                            <button type="submit" class="btn-outline" style="border-color:#FECACA; color:#991B1B;">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:16px;">
            {{ $productCategories->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    $('.datatable').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false,
        lengthChange: false,
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endsection
