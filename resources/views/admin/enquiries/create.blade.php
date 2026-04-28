@extends('layouts.admin')
@section('page-title', 'Add Enquiry')

@section('styles')
<style>
.form-card { background:#fff; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; }
.form-card-header { padding:16px 22px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:10px; }
.form-card-body { padding:22px; }
.field-label { display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px; }
.field-input, .field-textarea, .field-select { width:100%; padding:10px 14px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:13.5px; color:#1E293B; background:#fff; outline:none; }
.field-input:focus, .field-textarea:focus, .field-select:focus { border-color: var(--accent); box-shadow:0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent); }
.field-textarea { min-height:120px; resize:vertical; }
.field-error { color:#EF4444; font-size:12px; margin-top:6px; display:flex; align-items:center; gap:6px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:var(--accent); color:#fff; border:none; font-size:13.5px; font-weight:600; cursor:pointer; }
.btn-ghost { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:10px; background:#F8FAFC; color:#475569; border:1.5px solid #E2E8F0; text-decoration:none; }
</style>
@endsection

@section('content')
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
    <div>
        <a href="{{ route('admin.enquiries.index') }}" style="font-size:13px; color:var(--accent); text-decoration:none; font-weight:600;">← Back to enquiries</a>
        <h2 style="font-size:22px; font-weight:700; color:#0F172A; margin:10px 0 0;">Add Enquiry</h2>
        <p style="font-size:13px; color:#64748B; margin:6px 0 0;">Create a new enquiry record for follow-up.</p>
    </div>
</div>

<form action="{{ route('admin.enquiries.store') }}" method="POST">
    @csrf
    <div class="form-card">
        <div class="form-card-header">
            <div style="width:36px;height:36px;border-radius:12px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:16px;">
                <i class="fas fa-envelope"></i>
            </div>
            <div>
                <p style="font-size:14px;font-weight:700;color:#0F172A;margin:0;">Enquiry details</p>
                <p style="font-size:12px;color:#94A3B8;margin:2px 0 0;">Fill in the customer enquiry information.</p>
            </div>
        </div>
        <div class="form-card-body">
            <div style="display:grid; gap:18px;">
                <div>
                    <label class="field-label" for="product_id">Product</label>
                    <select name="product_id" id="product_id" class="field-select">
                        @foreach($products as $id => $label)
                            <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('product_id')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="name">Name <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="field-input">
                    @error('name')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                    <div>
                        <label class="field-label" for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="field-input">
                        @error('email')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label" for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="field-input">
                        @error('phone')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="field-label" for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="field-input">
                    @error('subject')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="field-label" for="message">Message</label>
                    <textarea name="message" id="message" class="field-textarea">{{ old('message') }}</textarea>
                    @error('message')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>

                <div style="display:grid; gap:18px; grid-template-columns:1fr 1fr; align-items:start;">
                    <div>
                        <label class="field-label" for="status">Status</label>
                        <select name="status" id="status" class="field-select">
                            <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>New</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                    </div>
                    <div style="display:flex; align-items:center; gap:12px; padding-top:24px;">
                        <label style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size:13px; color:#374151;">
                            <input type="checkbox" name="is_read" value="1" {{ old('is_read') ? 'checked' : '' }} style="width:auto;">
                            Mark as read
                        </label>
                    </div>
                </div>

                <div>
                    <label class="field-label" for="admin_note">Admin Note</label>
                    <textarea name="admin_note" id="admin_note" class="field-textarea">{{ old('admin_note') }}</textarea>
                    @error('admin_note')<p class="field-error"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px; display:flex; flex-wrap:wrap; gap:12px;">
        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Save Enquiry</button>
        <a href="{{ route('admin.enquiries.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection
