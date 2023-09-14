@extends('company.master')

@section('title', 'Company Dashboard | ' . env('APP_NAME'))


@section('content')

<!-- Button trigger modal -->
<div class="card">
    <div class="card-header">
      Pay <b class="text-primary">${{ $project->price }}</b> to <b class="text-danger">{{ $project->name }}</b>

    </div>
    <div class="card-body">

       @if (session('msg'))
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
       @endif

        <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
        <form action="{{ route('company.project_payment', $project->id) }}" class="paymentWidgets" data-brands="VISA MASTER AMEX MEEZA MADA"></form>

    </div>
  </div>
@endsection
