<html>
    <hr>
    @foreach($result as $group=>$list)
        <h2>{{$group}}</h2>
        <table width="100%" border="1">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Label</th>
            </tr>
                @foreach($list as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['label'] }}</td>
                </tr>
                @endforeach
        </table>
        <hr />
    @endforeach
    </body>
</html>
