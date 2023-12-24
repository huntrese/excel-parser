<table border="1">
    @foreach($data as $row)
    <tr>
        @foreach($row as $cell)
            <td colspan="{{ $cell['colspan'] }}" rowspan="{{ $cell['rowspan'] }}">{!! nl2br(e($cell['value'])) !!}</td>
        @endforeach
    </tr>
    @endforeach
</table>
