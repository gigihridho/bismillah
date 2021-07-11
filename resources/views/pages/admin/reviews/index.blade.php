@extends('layouts.admin')

@section('title')
    Review
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body" style="overflow-x:auto;">
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align:center">
                            <th class="text-center">
                            No
                            </th>
                            <th>Nama</th>
                            <th>Reviews</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $index => $review)
                                <tr style="text-align:center">
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $review->user->name }}</td>
                                        <td>{{ $review->review }}</td>
                                        <td>
                                            <a title="Hapus" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm edit" href="{{ route('reviews.create',$review->id) }}"  >
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('addon-script')
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );
</script>
@endpush

