<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Components') }}</title>
</head>

<body>
    <x-navbar />

    <div class="container center">

        <h1>{{ __('Components') }}</h1>
        <a href="{{ route('component.create', ['company_id' => $company->id]) }}">{{ __('Add component') }}</a>
        <table>
            <thead>
                <tr>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Position') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($components as $component)
                    <tr>
                        <td>{{ $component->type }}</td>
                        <td>{{ $component->order }}</td>
                        <td class="buttons">
                            <a class="button blue-button" href="{{ route('component.edit', $component) }}">{{ __('Edit') }}</a>
                            <form action="{{ route('component.destroy', $component) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button blue-button" type="submit">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
