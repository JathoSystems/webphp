<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p, ol {
            font-size: 16px;
            margin-bottom: 15px;
        }

        ol li {
            margin-left: 30px;
        }

        .signature {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>Algemene voorwaarden voor verkoop/verhuur van artikelen</h1>

    <p>Hierbij verklaren {{$company->name}} (hierna te noemen "Verkoper") en de klant (hierna te noemen "Koper/Huurder") als volgt:</p>

    <ol>
        <li>De Verkoper verklaart dat alle artikelen te koop/verhuur eigendom zijn van {{$company->name}} en vrij zijn van alle rechten en aanspraken van derden.</li>
        <li>De Koper/Huurder verklaart dat hij/zij de artikelen in de huidige staat heeft gezien en hiermee akkoord gaat.</li>
        <li>De betaling/verhuurprijs van de artikelen dient te geschieden binnen een onbepaald dagen na ondertekening van dit contract.</li>
        <li>De Verkoper draagt geen verantwoordelijkheid voor schade aan of verlies van de artikelen na levering/afhaal.</li>
        <li>De Koper/Huurder is verantwoordelijk voor het correct gebruik en onderhoud van de artikelen tijdens de huurperiode/na aankoop.</li>
        <li>Alle geschillen voortkomend uit dit contract zullen worden beslecht volgens de geldende wetgeving in Nederland.</li>
        <li>Dit contract blijft van kracht totdat alle verplichtingen zijn nagekomen.</li>
    </ol>

    <div class="signature">
        <p>Dit contract wordt ondertekend door:</p>
        <p>{{$company->name}}: _______________________________</p>
        <p>De Bazaar: _______________________________</p>
    </div>

</div>
</body>
</html>