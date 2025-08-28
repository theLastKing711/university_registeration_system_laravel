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
                @foreach($table_data as $data)
                    <tr>
                        <td>
                            {{$data["id"]}}
                        </td>
                        <td>
                            {{$data["date"]}}
                        </td>
                        <td>
                            {{$data["day"]}}
                        </td>
                        @foreach($data["exams"] as $exam)
                        <td>
                                @foreach($exam as $slot)
                                    {{ $slot ? $slot->courseTeacher->course->course->name : '' }}
                                    <br />
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