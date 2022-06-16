<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    </head>
    <style>
        #data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #data td,
        #data th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #data tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #data tr:hover {
            background-color: #ddd;
        }

        #data th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04aa6d;
            color: white;
        }
    </style>
    <body>
        <h1>Modal Produksi Bulan {{$bulan}}</h1>
        <table id="data">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Berat(Kg)</th>
                    <th scope="col">Harga(Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->tanggal}}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->berat}}</td>
                    <td>{{$item->harga}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
