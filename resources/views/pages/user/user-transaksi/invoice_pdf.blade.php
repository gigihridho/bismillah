<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utransaction-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Invoice {{ $now->format('d-m-Y') }}</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-secondary"><u>{{ $now->format('d-m-Y') }}</u></h4>
            </div>
        </div>
        <hr class="mb-3">
        <div class="row">
            <div class="col-md-12">
                <div style="text-align: center;">
                    <div>
                        <strong>Rincian Tagihan Booking </strong>
                    </div>
                    <small style="margin : 0px; display: block;">Alamat : Kentingan, Jebres, Surakarta</small>
                    <small style="margin : 0px; display: block;">Owner : Anggito Galih Nuragam</small>
                    <p style="margin : 0px;">HP/WA : 085770254568</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row my-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table border="1" width="100%" cellspacing="0" cellpadding="10" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="4"><strong>#</strong>
                                    {{ $transaction->code }}
                                </th>
                                <th scope="col" colspan="4">
                                    {{ $now->format('d-m-Y') }}
                                </th>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b>Penyewa: </b>
                                    <p>{{ $transaction->user->name }}<br>
                                        {{ $transaction->user->no_hp }}<br>
                                        {{ $transaction->user->email }}<br>
                                    </p>
                                </td>
                                <td colspan="4">
                                    <b>Kamar: </b>
                                    <p>{{ $transaction->room->room_type->name }}
                                    {{ $transaction->room->room_number }}</p>
                                        <p>Tanggal Order : {{ $transaction->order_date }} </p>
                                        <p>Tanggal Masuk :
                                        {{ $transaction->arrival_date }} </p>
                                        <p>Tanggal Keluar :
                                        {{ $transaction->departure_date }} </p>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col" colspan="8">Nomor Rekening Tujuan</th>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <b>BNI a.n Anggito Galih  </b>
                                    <p>0889322111</p>
                                    <b>OVO </b>
                                    <p>089888222111</p>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" colspan="4">Total Harga</th>
                                <td colspan="4">
                                {{ $transaction->total_price }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>
