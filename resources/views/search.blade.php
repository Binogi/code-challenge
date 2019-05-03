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
            margin: 50px;
        }
        .content {
            position:absolute;
            height:90%; /* = 100% - 2*10% padding */
            width:90%; /* = 100% - 2*5% padding */
            padding: 1% 1%;
        }
        .square {
            float:left;
            position: relative;
            width: relative;
        	border: 1px solid black;
            padding: 1%; /* = width for a 1:1 aspect ratio */
            margin:1%;
            overflow:hidden;
        }
        .full-height {
            height: 100vh;
        }

        .result {
        }

    </style>
</head>
<body>

<div class="content">
  <form method="post" action="/info">
      {{csrf_field()}}
    <div>
        Your Search Term Was: <b>{{$searchTerm}}</b>
    </div>
    <br>
    <div class="square">
      <strong>Artist</strong>
      <table>
      <?php  $i=0 ?>
      @foreach ($artist_results as $result)
      <tr>
        <td><a href="{{ route('info_artist', ['id'=>$result->id ]) }}"><img src='{{ $artist_pics[$i]->url }}'><br> {{ $result->name }}</a></td>
      </tr>
      <?php $i++ ?>
      @endforeach
    </table>
    </div>
    <div class="square">
      <strong>Album</strong>
      <table>
        <?php  $i=0 ?>
      @foreach ($album_results as $result)
      <tr>
        <td><a href="{{ route('info_album', ['id'=>$result->id ]) }}"><img src='{{ $album_pics[$i]->url }}'><br>{{ $result->name }}</a></td>
      </tr>
      <?php $i++ ?>
      @endforeach
    </table>
    </div>
    <div class="square">
      <strong>Tracks</strong>
      <table>
      @foreach ($track_results as $result)
      <tr>
        <td><a href="{{ route('info_track', ['id'=>$result->id ]) }}"><img src='{{ $result->album->images[2]->url }}'><br>{{ $result->name }}</a></td>
      </tr>
      @endforeach
    </table>
    </div>
    </form>
</div>
</body>
</html>
