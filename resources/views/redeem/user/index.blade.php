@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-3">🎁 Redeem Poin</h2>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- INFO USER --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5>Halo, {{ auth()->user()->name }}</h5>
            <p class="mb-0">
                Total Poin Kamu: 
                <strong>{{ auth()->user()->points }}</strong>
            </p>
        </div>
    </div>

    {{-- LIST REWARD --}}
    <div class="row">
        @forelse ($rewards as $reward)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $reward->name }}</h5>

                        <p class="card-text">
                            Biaya: <strong>{{ $reward->point_cost }} poin</strong>
                        </p>

                        @if(auth()->user()->points >= $reward->point_cost)
                            <form action="{{ route('redeem.store', $reward->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    Redeem
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary w-100" disabled>
                                Poin Tidak Cukup
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Belum ada reward yang tersedia.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
