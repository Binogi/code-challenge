<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Code Challenge</title>
  <style>
    html,
    body {
      background-color: #fff;
      color: #636b6f;
      font-family: sans-serif;
      height: 100vh;
      margin: 50px;
    }

    .full-height {
      height: 100vh;
    }

    .result {}


    <style>
    table {
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

  </style>

</head>

<body>
  <div class="full-height">
    <div class="result">
      Your Search Results About <b>{{$searchTerm}}</b> are:
    </div>
    <div>
      @if (empty($artists))
      There is no results for {{ $searchTerm }}
      <form action="/" method="get">
      <button type="submit">Try Again</button>
      </form>
      @else
      <form method="get" action="/">
      <button type="submit">Search For another Artist</button>
      </form>

      <table>
      <caption>{{ $searchTerm }} relative information</caption>
        <thead>
          <tr>
            <th>Artists</th>
            <th>Albums</th>
            <th>Tracks</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td valign="top">
              <table>
                @foreach($artists as $artist)
                <tr>
                  <td valign="top">
                    <a href='/search/artist/{{ $artist->id }}'>
                      @if(count($artist->images) > 1)
                      <img src='{{ $artist->images[1]->url }}' />
                      @else
                      <img src="/img/spotify-logo.png" />
                      @endif
                      {{ $artist->name }}
                    </a>
                  </td>
                </tr>
                @endforeach
              </table>
              @endif
            </td>
            <td valign="top">
              <table>
                @foreach ($albums as $album)
                <tr>
                  <td valign="top">
                    <a href='{{ $album->external_urls->spotify }}' target='_blank'>
                      @if(count($album->images) > 1)
                      <img src='{{ $album->images[1]->url }}' />
                      @else
                      <img src="/img/spotify-logo.png" />
                      @endif
                      {{ $album->name }}                     
                    </a>
                  </td>
                </tr>

                @endforeach
              </table>
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
    </div>
  </div>

</body>

</html>