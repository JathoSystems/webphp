<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertenties</title>
</head>
<body>
<div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="h-fit">
                <br>
                <h2>Advertentie Overzicht</h2>
                <br>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase dark:bg-gray-900 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 hidden lg:block">Titel</th>
                            <th scope="col" class="px-6 py-3">Omschrijving</th>
                            <th scope="col" class="px-6 py-3">Prijs</th>
                            <th scope="col" class="px-6 py-3">Type</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ads as $ad)
                            @php
                                $thumbnail = isset($ad['thumbnail']) ? json_decode(trim(html_entity_decode($ad['thumbnail'])), true) : null;
                            @endphp

                        <tr>
                            <td class="py-2 px-4 border-b hidden lg:block">
                                @if ($thumbnail)
                                    <!-- Gebruik $thumbnail in je HTML of Blade-code -->
                                    <img src="{{ Storage::disk('content_CMS')->url($thumbnail['url']) }}" alt="thumbnail" style="height: 15vh; width: 20vw;"></style>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $ad->title }}</td>
                            <td class="py-2 px-4 border-b">{{ $ad->description }}</td>
                            <td class="py-2 px-4 border-b">{{ $ad->price }}</td>
                            <td class="py-2 px-4 border-b">{{ $ad->type }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex">
                                    <a href="{{ route('ads.edit', $ad->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Bewerken</a>
                                    <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Weet je zeker dat je deze advertentie wilt verwijderen?')">Verwijderen</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <a href="{{ route('ads.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Nieuwe advertentie toevoegen
                </a>
                

            </div>
        </div>
    </div>
</body>
</html>