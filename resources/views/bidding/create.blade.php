<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedingen</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger mb-4 d-flex justify-content-center align-items-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Maak een bod</h2>
                <form action="{{ route('biddings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="adId" value="{{ $adId }}">
                        <label for="price">Prijs:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Voer prijs in" required>
                        <small class="form-text text-muted">Gelieve een geldige waarde invoeren (e.g., 10.99).</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Verstuur</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
