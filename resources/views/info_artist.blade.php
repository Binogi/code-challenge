<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Challenge</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .img {
            width: 5vw
        }

        .search {
            margin-left: 100px;
        }
    </style>
</head>
<body>
<div class="flex-center full-height">
    <div>
      <table>
              @foreach ($artist as $info)
              <img src='{{ $info->images[2]->url }}'>
            <tr><td>Artist name:</td><td>{{ $info->name }}</td></tr>
            <tr><td>Artist genré:</td>
                @foreach ($info->genres as $genre)
                <td>{{ $genre }},</td>
                  @endforeach
            </tr>
            <tr><td>Followers:</td><td>{{ $info->followers->total }}</td></tr>
              @endforeach
      </table>

    </div>

</div>
</body>
</html>
