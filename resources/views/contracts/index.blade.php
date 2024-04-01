<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__("Contracts")}}</title>
</head>
<body>
    <x-navbar />
    <div class="container">

        <h1>{{ __('Uploaded contracts') }}</h1>

        @if(auth()->user()->hasRole('admin'))
            <a class="button blue-button" href="{{ route('contracts.create') }}">{{ __('Add contract') }} <i class="fas fa-plus"></i></a>
        @endif
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>{{ __('Company') }}</th>
                    <th>{{ __('File') }}</th>
                    <th>{{ __('Date uploaded') }}</th>
                    <th>{{ __('Approved') }}</th>
                    @if(auth()->user()->hasRole('zakelijk'))
                        <th></th>
                    @endif        
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
                            @if(auth()->user()->hasRole('zakelijk'))
                                <td></td>
                            @endif
                        @else
                            <td>{{ __('No') }}</td>
                            @if(auth()->user()->hasRole('zakelijk'))
                                <td>
                                    <form action="{{ route('contracts.approve', $contract->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="button">{{ __('Approve') }}</button>
                                    </form>
                                </td>
                            @endif
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br><br>
        {{$contracts->links()}}
    </div>
</body>
</html>