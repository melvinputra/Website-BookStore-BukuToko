@extends('layouts.admin')

@section('title', 'Daftar User')
@section('breadcrumb', 'Users')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(139, 92, 246, 0.1);
    }

    .page-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
    }

    .modern-table {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.1);
    }

    .modern-table thead {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    }

    .modern-table thead th {
        color: #ffffff !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border: none !important;
        background: transparent !important;
    }

    .modern-table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #F3F4F6;
        color: #4B5563;
        font-size: 0.95rem;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
    }

    .modern-table tbody tr:hover {
        background: rgba(139, 92, 246, 0.03);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 1rem;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .role-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .role-badge.admin {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(124, 58, 237, 0.1) 100%);
        color: #7C3AED;
        border: 1px solid rgba(139, 92, 246, 0.3);
    }

    .role-badge.user {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .date-badge {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #6B7280;
        font-size: 0.9rem;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9CA3AF;
    }

    .empty-state i {
        font-size: 4rem;
        color: #E5E7EB;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-title-wrapper">
        <div class="page-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <h1 class="page-title">Daftar User</h1>
    </div>
</div>

<div class="modern-table">
    <table class="table">
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="30%">User</th>
                <th width="30%">Email</th>
                <th width="15%">Role</th>
                <th width="17%">Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td><strong>{{ $index + 1 }}</strong></td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                            </div>
                            <strong>{{ $user->nama }}</strong>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-badge {{ strtolower($user->role) }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <div class="date-badge">
                            <i class="bi bi-calendar-check"></i>
                            {{ $user->created_at->format('d M Y') }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-person-x"></i>
                            <p>Tidak ada user terdaftar</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
