<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Add contract') }}</title>
</head>
<body>
<x-navbar />

<div class="container">
    <h1>{{__("Add contract")}}</h1>
    <form class="form" action="{{ route('contracts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="company">{{__("For company")}}</label>
        <select name="company" id="company">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        <button class="button" type="submit">{{__("Save")}}</button>
    </form>
    <br>
    <a class="button" href="{{ route('contract.index') }}">{{__("Back to overview")}}</a>
</div>    

</body>
</html>