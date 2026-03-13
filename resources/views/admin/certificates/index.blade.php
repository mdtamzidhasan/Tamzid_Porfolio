@extends('admin.layout')
@section('page-title', 'Certificates')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Certificate
    </a>
</div>

<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>All Certificates ({{ $certificates->count() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th width="80">Image</th>
                <th>Title</th>
                <th>Issuer</th>
                <th>Category</th>
                <th>Issue Date</th>
                <th>Status</th>
                <th width="120">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($certificates as $cert)
            <tr>
                <td>
                    <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}"
                        style="width:70px;height:50px;object-fit:cover;border-radius:8px;">
                </td>
                <td><strong>{{ $cert->title }}</strong></td>
                <td>{{ $cert->issuer }}</td>
                <td><span class="badge badge-primary">{{ $cert->category ?? 'General' }}</span></td>
                <td style="color:var(--text-muted);font-size:13px">{{ $cert->issue_date }}</td>
                <td><span
                        class="badge {{ $cert->is_active ? 'badge-success' : 'badge-danger' }}">{{ $cert->is_active ? 'Active' : 'Hidden' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ $cert->image_url }}" target="_blank" class="action-btn view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.certificates.edit', $cert) }}" class="action-btn edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST"
                            style="display:inline" onsubmit="return confirm('Delete this certificate?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px">
                    No certificates yet. <a href="{{ route('admin.certificates.create') }}"
                        style="color:var(--accent)">Add one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection