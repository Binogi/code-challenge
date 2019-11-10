<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Top Tracks</title>
  <style>
    html,
    body {
      background-color: #fff;
      color: #636b6f;
      font-family: sans-serif;
      height: 100vh;
      margin: 10px;
    }

    .full-height {
      height: 100vh;
    }

    .result {}


    <style>table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>

</head>

<body>
  @if (empty($tracks))
  Thera are no retrieval information about {{ $artist->name }}
  <form action="/"  method="get">
    <input type="submit" value="Try Again">
  </form>
  @else

  @if($artist->name)
  <h2>{{ $artist->name }}.'s Related Artists</h2>
  @endif
  <table>
    <!-- <caption>{{ $artist->name }}'s Related Artists</caption> -->
    <thead>
      <tr>
        <th>Related Artists</th>
        <th>Tracks</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td valign="top">
          <table>
            @foreach($relartists as $relartist)
            <tr>
              <td valign="top">
                <a href='{{ $relartist->external_urls->spotify }}' target='_blank'>
                  @if(count($relartist->images) > 1)
                  <img src='{{ $relartist->images[1]->url }}' />
                  @else
                  <img src="/img/spotify-logo.png" />
                  @endif
                  {{ $relartist->name }}
                </a>
              </td>
            </tr>
            @endforeach
          </table>
          @endif
        </td>
        <td valign="top">
          <table>
            @foreach ($tracks as $track)
            <tr>
              <td valign="top">
                @if ($track->external_urls->spotify)
                <a href='{{ $track->external_urls->spotify }}' target='_blank'>
                  @endif
                  @if(count($track->album->images) > 1)
                  <img src='{{$track->album->images[1]->url }}' />
                  @else
                  <img src="/img/spotify-logo.png" />
                  @endif
                  {{ $track->name }}
                </a>
              </td>
            </tr>

            @endforeach
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>