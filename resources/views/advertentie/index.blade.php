<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__("Advertisements")}}</title>
</head>

<body>
    <x-navbar />
    <div class="container">

        @if (!$favorieten)
            <h1>{{__("Advertisements")}}</h1>
        @else
            <h1>{{__("Favorite adverisements")}}</h1>
        @endif
        @if (!$favorieten)
            @auth
                @if (auth()->user()->canAdvertise())
                    <a class="button blue-button" href="{{ route('advertentie.create') }}">{{__("Add advertisement")}} <i
                            class="fas fa-plus"></i></a>
                @endif
            @endauth
        @endif
        <table>
            <thead>
                <tr>
                    <th>{{__("Title")}}</th>
                    <th>{{__("Description")}}</th>
                    <th>{{__("Price")}}</th>
                    <th>{{__("Image")}}</th>
                    <th>{{__("Type")}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($advertenties as $advertentie)
                    <tr>
                        <td>{{ $advertentie->title }}</td>
                        <td>{{ $advertentie->description }}</td>
                        <td>{{ $advertentie->price }}</td>
                        @if ($favorieten)
                            @php
                                $img_src = '../storage/images/';
                            @endphp
                        @else
                            @php
                                $img_src = 'storage/images/';
                            @endphp
                        @endif

                        <td><img src="{{ asset($img_src . $advertentie->image_url) }}" alt="{{ $advertentie->titel }}"
                                style="width: 100px;"></td>
                        <td>
                            @if ($advertentie->type === 'verhuur_advertentie')
                                {{__("Rent advertisement")}}
                            @else
                                {{__("Purchase advertisement")}}
                            @endif
                        </td>
                        <td>
                            <div class="buttons">
                                @if (!$favorieten && $advertentie->user_id === auth()->id())
                                    <form action="{{ route('advertentie.edit', $advertentie) }}" method="get">
                                        @csrf
                                        <button class="button" type="submit">{{__("Edit")}}</button>
                                    </form>
                                    <form action="{{ route('advertentie.destroy', $advertentie) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="button" type="submit">{{__("Delete")}}</button>
                                    </form>
                                @endif
                                <form action="{{ route('advertentie.favorite', $advertentie) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="button">{{__("Favorite")}}</button>
                                </form>
                                <a class="button"
                                    href="{{ route('advertentie.show', $advertentie) }}">{{ __('View') }}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
