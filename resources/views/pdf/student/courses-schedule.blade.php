<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-details table { width: 100%; border-collapse: collapse; }
        .invoice-details th, .invoice-details td { border: 1px solid #ccc; padding: 8px; text-align: right; direction: rtl; }
    </style>
</head>
<body>
    <!-- <div class="invoice-header">
        <h1>Invoice # </h1>
        <p>Date: </p>
    </div> -->

    <div class="invoice-details">
        <table>
            <thead>
                <tr>
                   @foreach($table_headers as $header)
                            <td>{{$header}}</td>
                     @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($table_data as $time_interval => $time_interval_row)
                    <tr>
                        <td>
                            {{$time_interval}}
                        </td>
                        @foreach($time_interval_row as $day_slot_data)
                            <td>
                                @foreach($day_slot_data as $slot)
                                    {{ 
                                        $slot     
                                    }}
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            <!-- <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Grand Total:</strong></td>
                    <td><strong></strong></td>
                </tr>
            </tfoot> -->
        </table>
    </div>
</body>
</html>