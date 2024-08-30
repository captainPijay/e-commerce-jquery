@extends('back_office.layouts.index')
@section('content')
@inject('carbon', 'Carbon\Carbon')
<div class="content-header">
    <div class="header-welcome">
        <h2 class="title">Halo, {{ auth()->guard('customers')->user()->name ?? auth()->guard('web')->user()->name }}</h2>
        <p class="desc">Selamat Datang Di Aplikasi Digdaya Fullstack Tes</p>
    </div>
</div>
<div class="row content-info">
    <div class="col-lg-4 col-6">
        <div class="info-box">
            <div class="info-icon">
                <i class="ri-community-fill"></i>
            </div>
            <div class="info-text">
                <p>Total Rupiah Penjualan Tanggal {{ $carbon::now()->format('d M Y') }}</p>
                <h3>{{ $totalRupiah }}</h3>
            </div>
        </div>
    </div>
</div>
<style>
    .content-header {
        width: 100%;
        margin-bottom:10px;
        display:flex;
        justify-content:space-between;
        padding: 0 10px;
    }

    .content-info {
        padding: 0 10px;
    }

    .header-welcome .title {
        font-size: 24px;
        color: #212529;
        font-weight: bold;
    }

    .header-welcome .desc {
        font-size: 14px;
        color: #898989;
    }

    .header-filter .form-select {
        box-shadow: 0 1px 8px 0 rgb(0, 0, 0, 0.2);
        border: none;
        border-radius: 8px;
    }

    .content-info .info-box {
        display: flex;
        align-items: center;
        background-color: #FFF;
        box-shadow: 0 1px 8px 0 rgb(0, 0, 0, 0.2);
        border-radius: 16px;
        padding: 20px;
    }

    .content-info .info-box .info-icon {
        color: #FFF;
        background-color: #556FF6;
        width: 60px;
        height: 60px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 40px;
    }

    .content-info .info-box .info-text p {
        font-size: 14px;
        color: #484848;
        margin-bottom: 5px;
    }

    .content-info .info-box .info-text h3 {
        font-family: "Rubik";
        font-size: 28px;
        color: #1C2434;
        margin-bottom: 0;
    }
</style>
@endsection
