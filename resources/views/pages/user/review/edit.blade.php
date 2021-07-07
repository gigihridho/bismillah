@extends('layouts.user')

@section('title')
Review
@endsection

@section('content')
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
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header">
                        <h4>Review</h4>
                        </div>
                    <div class="card-body">
                        <form action="{{ route('review-user-redirect','review-user') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="review">Review</label>
                                <input type="text" name="review" id="review" value="{{ $review }}" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
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
