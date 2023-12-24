<!DOCTYPE html>
<html>
<head>
    <title>Excel Data</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <table>
        @foreach($data as $row)
            <tr>
                @foreach($row as $cell)
                    @if(isset($cell['isMerged']) && $cell['isMerged'])
                        <td rowspan="{{ $cell['rowSpan'] }}" colspan="{{ $cell['colSpan'] }}">{{ $cell['value'] }}</td>
                    @else
                        <td>{{ $cell['value'] }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>
