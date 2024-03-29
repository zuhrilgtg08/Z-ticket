<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Data Orders</title>
        <style>
            * {
                font-family: DejaVu Sans, sans-serif;
            }

            body {
                padding: 20px;
            }

            table {
                font-size: 1em;
                font-weight: 400;
                color: #000;
            }

            h2 {
                font-size: 1em;
                font-weight: 400;
            }

            h1 {
                font-size: 1.5em;

            }

            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
            }

            th {
                border: 1px solid #808080;
                background-color: #cac9c9;
                text-align: center;
                padding: 8px;
            }

            td {
                border: 1px solid #747171;
                padding: 8px 8px 0px 8px;
            }

            tr:nth-child(even) {
                background-color: #F5F5F5;
            }
        </style>
    </head>

    <body>
        <center>
            <h1 style="text-decoration: underline;">DATA ORDERS CUSTOMERS</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Tiket</th>
                        <th>Nama Hotel</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Payment Status</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ( $data as $dt )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $dt->pesanan->uuid}}</td>
                            <td>{{ $dt->tiket->nama_tiket}}</td>
                            <td>{{ $dt->hotel->nama_hotel}}</td>
                            <td>{{ $dt->quantity}}</td>
                            <td>@harga($dt->tiket->harga)</td>
                            <td>{{ $dt->status_pembayaran}}</td>
                            <td>{{ date('Y-m-d', strtotime($dt->pesanan->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </center>
    </body>
</html>