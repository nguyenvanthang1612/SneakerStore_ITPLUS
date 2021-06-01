@extends('frontend.layouts.app')

@section('title')
Step 4
@endsection

@push('css')
<style>
    .float-block .wrap {
        padding-top: 0;
    }

</style>
@endpush

@section('content')
<!--
        BREADCRUMBS
        =============================================== -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">

            <ol class="breadcrumb bg-blue">
                <li><a href="#">Homepage</a></li>
                <li><a href="#">Blog category</a></li>
                <li class="active">This item</li>
            </ol>

        </div>
    </div>
</div>
<!-- END: BREADCRUMBS -->

<div class="container">

    @include('frontend.shoppingCart._step', [
        'step' => 3
    ])
    <!--
            CONTENT
            =============================================== -->
    <div class="row block none-padding-top">

        <div class="col">
            <div class="sdw-block">
                <div class="wrap bg-white">
                    <!-- / Authirize form -->

                    <div class="row">
                        <h2>Cảm ơn bạn đã đặt hàng</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT -->

</div>
@endsection
