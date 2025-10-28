<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Tajawal-Medium', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            direction: rtl;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            direction: rtl;
            text-align: right;
        }

        th, td {
            padding-top: 2mm;
            padding-bottom: 2mm;
            border-left: 0;
            border-right: 0;
        }

        .border-b {
            border-bottom: 1px solid #333;
        }

        .border-b-d {
            border-bottom: 1px dashed #999;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 3mm;
        }

        .invoice-header h1 {
            font-size: 16px;
            margin-top: 3mm;
        }

        .invoice-footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10mm;
        }

        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        h2 {
            padding-top: 0.5mm;
            text-align: center;
            padding-bottom: 0mm;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>{{$site_name}}</h1>
        <p>{{$site_description}}</p>
        <h2>فاتورة مبيعات</h2>
        <p>رقم الفاتورة: #{{ str_pad($invoiceNumber, 6, '0', STR_PAD_LEFT) }}</p>
        <p>التاريخ: {{ $date }}</p>
        <p>الوقت: {{ $time }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>المنتج</th>
                <th class="text-center">السعر</th>
                <th class="text-center">الكمية</th>
                <th class="text-right">الإجمالي</th>
            </tr>
            <tr>
                <th class="border-b-d" colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            @php 
                $i = 0; 
                $total_price = 0;
                $total_tax = [];
                $grand_total = 0;
            @endphp
            @foreach($items as $item)
                @php $i++; @endphp
                <tr>
                    <td colspan="4">{{ $i.'. '.$item->product->name }}</td>
                </tr>
                <tr>
                    <td>الضريبة {{(int)$item['tax']}}%</td>
                    <td class="text-center">{{ number_format($item['price'], 2, '.', '') }}</td>
                    <td class="text-center">{{ $item['quantity'] }}</td>
                    @php 
                        $tax = $item['tax'];
                        $item_total = $item->price * $item->quantity;
                        $tax_amount = ($item_total * $tax) / 100;
                        $item_total_with_tax = $item_total + $tax_amount;
                        $total_price += $item_total;
                        $total_tax[$tax] = ($total_tax[$tax] ?? 0) + $tax_amount;
                        $grand_total += $item_total_with_tax;
                    @endphp
                    <td class="text-right">{{ number_format($item_total_with_tax, 2, '.', '') }}</td>
                </tr>
                <tr>
                    <td class="border-b-d" colspan="4"></td>
                </tr>
            @endforeach

            <tr>
                <td class="text-center" colspan="4" style="padding-top:3mm; font-size:16px">
                    الإجمالي
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:16px;">الإجمالي الفرعي</td>
                <td class="text-right" style="font-size:16px">{{$order->total_price}}</td>
            </tr>

            @foreach ($total_tax as $rate => $amount)
                <tr>
                    <td colspan="3" style="font-size:16px;">ضريبة القيمة المضافة {{ (int)$rate }}%</td>
                    <td class="text-right" style="font-size:16px">{{$amount}}</td>
                </tr>
            @endforeach

            <tr>
                <td class="border-b-d" colspan="4"></td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:16px">الإجمالي الكلي</td>
                <td class="text-right" style="font-size:16px">{{ number_format($grand_total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="invoice-footer">
        <p>شكرًا لتعاملكم معنا</p>
    </div>
    @if(request()->has('print'))
<script>
    window.onload = function() {
        window.print();
    };
</script>
@endif

</body>
</html>
