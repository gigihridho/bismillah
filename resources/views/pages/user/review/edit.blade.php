@extends('layouts.user')

@section('title')
Review
@endsection

@section('content')
<style>
    .btn-filll{
        background-color: #6777ef;
        border-radius: 12px;
        padding: 12px 28px;
    }
    .btn-fill:hover{
        background: #000;
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($user as $rev)
                            <form action="{{ route('review-user-update','review-user') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" value="{{ $rev->name }}" class="form-control" disabled>
                            </div>
                            @endforeach

                        @if(count($review) > 0)
                            @foreach ($review as $revv)
                            <div class="form-group">
                                <label for="review">Review</label>
                                <input type="text" name="review" id="review" class="form-control"
                                value="{{ $revv->review }}" autocomplete="off" placeholder="Masukkan Review">
                                <small>Contoh: Kost bersih dan nyaman</small>
                            </div>
                            @endforeach
                        @else
                            <div class="form-group">
                                <label for="review">Review</label>
                                <input type="text" name="review" id="review" class="form-control"
                                value="" autocomplete="off" placeholder="Masukkan Review">
                                <small>Contoh: Kost bersih dan nyaman</small>
                            </div>
                        @endif
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5 text-white mb-3" style="padding: 8px 16px" >
                                        Simpan Data
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
