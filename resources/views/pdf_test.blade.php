<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Hello, world!</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
            }
        }

        .left-asset {
            position: absolute;
            left: 35px;
        }

        .left-asset .img-logo {
            position: absolute;
            top: 26px;
            width: 169px;
            height: auto;
        }

        .left-asset .title {
            position: relative;
            top: 200px;
            font-size: 20px;
            line-height: 23px;
            font-weight: bold;
        }

        .date-in {
            left: 35px;
            position: absolute;
            top: 250px;
            font-style: normal;
            font-weight: bold;
            font-size: 12px;
            line-height: 30px;
            color: #76AF30;
        }

        .date-out {
            left: 150px;
            position: absolute;
            top: 250px;
            font-style: normal;
            font-weight: bold;
            font-size: 12px;
            line-height: 30px;
            color: #76AF30;
        }

        p {
            font-size: 12px;
            line-height: 14px;
        }

        p.contact-info {
            position: absolute;
            width: 169px;
            left: 500px;
            top: 35px;
        }

        p.title-order {
            position: absolute;
            width: 169px;
            left: 500px;
            top: 144px;
            font-weight: bold;
            font-size: 15px;
            line-height: 14px;
        }

        .color-dg {
            color: #026930;
        }

        table,
        td {
            border-bottom: 3px solid #76AF30;
            border-collapse: collapse;
        }

        th {
            border-top: 3px solid #76AF30;
            color: #76AF30;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }

        .none-border {
            border: 0px;
        }
    </style>
</head>

<body>
    <div class="left-asset">
        <img class="img-logo" src="https://apininetyninekonveksi.krotidesian.xyz/public/99logo-min.png" alt="">
        <p class="title color-dg">
            Faktur INV/{{ $order->id }}
        </p>
        <table style="width: 600px;top: 325px;position: absolute;">
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Quantitas</th>
                <th>Subtotal</th>
            </tr>
            @foreach ($order->order_details as $order_detail)
            <tr>
                <td>{{$order_detail->product_name}}</td>
                <td>Rp. {{number_format($order_detail->total_price/$order_detail->qty,2)}}</td>
                <td>{{$order_detail->qty}}</td>
                <td>Rp. {{number_format($order_detail->total_price,2)}}</td>
            </tr>
            @endforeach
            <tr>
                <th class="none-border" colspan="2"></th>
                <th style="text-align: left;" colspan="1">Subtotal</th>
                <td>Rp {{ number_format($order->total_price,2) }}</td>
            </tr>
            @foreach ($order->order_payments as $order_payment)
            <tr>
                <th class="none-border" colspan="2"></th>
                <th colspan="1" style="color: black;text-align: left;">Dibayar pada
                    <br><small><i>{{$order_payment->created_at}}</i></small>
                </th>
                <td>Rp {{ number_format($order_payment->nominal,2) }}</td>
            </tr>
            @endforeach
            <tr>
                <th class="none-border" colspan="2"></th>
                <th style="text-align: left;" colspan="1">Belum Dibayarkan</th>
                <td>Rp {{ number_format($order->total_money,2) }}</td>
            </tr>
            <tr>
                <th class="none-border" colspan="2"></th>
                <th style="text-align: left;" colspan="1">Status</th>
                <td>{{ $order->status }}</td>
            </tr>
        </table>
    </div>
    <p class="contact-info"><b>NINENTYNINE KONVEKSI</b><br>
        {{$order->user->name}} <br>
        Telp. {{$order->user->phone}} <br>
        Email ninetyninekonveksi@gmail.com
    </p>
    <p class="title-order">{{$order->title}}/{{$order->customer_name}}</p>
    <div class="date-in">
        <p>Tanggal Faktur</p>
        <p style="color: black;">{{$order->start_date}}</p>
    </div>
    <div class="date-out">
        <p>Jatuh Tempo</p>
        <p style="color: black;">{{$order->end_date}}</p>
    </div>
</body>

</html>