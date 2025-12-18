@extends('layouts.admin')

@section('content')
<h2>Detail Penarikan</h2>

<p><b>Nama User:</b> {{ $withdrawal->user->name }}</p>
<p><b>Kode:</b> {{ $withdrawal->withdrawal_code }}</p>
<p><b>Jumlah:</b> Rp {{ number_format($withdrawal->amount,0,',','.') }}</p>
<p><b>Status:</b> {{ ucfirst($withdrawal->status) }}</p>

<hr>

<form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST" style="display:inline">
    @csrf
    <button type="submit" style="background:green;color:white;padding:8px">
        Approve
    </button>
</form>

<form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST" style="display:inline">
    @csrf
    <button type="submit" style="background:red;color:white;padding:8px">
        Reject
    </button>
</form>

@endsection
