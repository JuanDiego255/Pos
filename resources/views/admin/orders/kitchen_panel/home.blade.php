@extends('admin.template')
@section('content')
<section class="basic-select2">
    <div class="row">
        <!-- Congratulations Card -->
        <div class="col-12">
            <div class="card-body">
                <div class="col-xl-12">
                    <div id="wrapper-kitchen" class="row"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@include('admin.orders.kitchen_panel.js-home')
@endsection
