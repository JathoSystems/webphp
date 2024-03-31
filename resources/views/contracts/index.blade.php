<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__("Bids")}}</title>
</head>
<body>
    <x-navbar />
    <div class="container">

        <h1>{{ __('Uploaded contracts') }}</h1>

        <a class="button blue-button" href="{{ route('contracts.create') }}">{{ __('Add contract') }} <i class="fas fa-plus"></i></a>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>{{ __('Company') }}</th>
                    <th>{{ __('File') }}</th>
                    <th>{{ __('Date uploaded') }}</th>
                    <th>{{ __('Approved') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $contract)
                    <tr>
                        <td>{{ $contract->bedrijf->name }}</td>
                        <td><a href="{{ asset('storage/pdfs/' . $contract->file) }}" target="_blank">{{ __('Click here') }}</a></td>
                        <td>{{ $contract->created_at }}</td>

                        @if ($contract->approved)
                            <td>{{ __('Yes') }}</td>
                        @else
                            <td>{{ __('No') }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>