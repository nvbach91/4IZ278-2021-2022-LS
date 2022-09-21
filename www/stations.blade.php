<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Galaxies</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="antialiased">
  <h1>Galaxies</h1>

  <main class="mY-5 my-suto d-flex">
    <div class="container">
      <div class="row">
        <div class="col m-5">
          @foreach ($galaxies as $galaxy)
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ $galaxy->image }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{ $galaxy->name }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Size: {{ $galaxy->size }}</h6>
              <a href="galaxy.php?galaxy_id={{ $galaxy->id }}" class="btn btn-primary">Select galaxy</a>
            </div>
          </div>
          @endforeach
        </div>
        <div class="col-6 m-5">
          @foreach ($stations as $station)
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ $station->image }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{ $station->name }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">3D GPS: {{ $station->3d_gps }}</h6>
              <a href="station.php?station_id={{ $station->id }}" class="btn btn-primary">View station</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

</body>

</html>