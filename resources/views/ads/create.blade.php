<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertentie aanmaken</title>
</head>
<body>
<br>
        @if ($errors->any())
            <div class="alert alert-danger mb-4 flex justify-center items-center w-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif

        <div class="min-h-screen flex items-center justify-center">
            <form
                @if(isset($ad)) 
                    action="{{ route('ads.update', $ad->id) }}" 
                    method="POST" 
                @else 
                    action="{{ route('ads.store') }}" 
                    method="POST" 
                @endif
                enctype="multipart/form-data"
                class="bg-gray-900 shadow-md rounded px-8 pt-6 pb-8 mb-4 text-white">
                @csrf
                @if(isset($ad))
                    @method('PATCH')
                @endif
                <h1 class="text-2xl font-bold mb-8">
                    @if(isset($ad))
                        Bewerk formulier advertentie
                    @else
                        Aanmaak formulier advertentie
                    @endif
                </h1>
                <div class="mb-4">
                    <label for="title" class="block text-sm font-bold mb-2">Titel:</label>
                    <input type="text" class="mt-1 p-2 w-full rounded-md border-gray-700 text-black" id="title" name="title" 
                        @if(isset($ad)) 
                            value="{{ $ad->title }}" 
                        @endif
                        required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-bold mb-2">Omschrijving:</label>
                    <textarea class="mt-1 p-2 w-full rounded-md border-gray-700 text-black" id="description" name="description" rows="4" required>@if(isset($ad)){{ $ad->description }}@endif</textarea>
                </div>


                <div class="mb-4">
                    <label for="price" class="block text-sm font-bold mb-2">Prijs:</label>
                    <input type="number" class="mt-1 p-2 w-full rounded-md border-gray-700 text-black" id="price" name="price" 
                        @if(isset($ad)) 
                            value="{{ $ad->price }}" 
                        @endif
                        required>
                </div>


                <div class="mb-4">
                    <label for="type" class="block text-sm font-bold mb-2">Type:</label>
                    <select id="type" name="type" class="mt-1 p-2 w-full rounded-md border-gray-700 text-black" required>
                        <option value="" disabled selected>Kies een type</option>
                        <option value="koop" @if(isset($ad) && $ad->type == "koop") selected @endif>Koop</option>
                        <option value="verhuur" @if(isset($ad) && $ad->type == "verhuur") selected @endif>Verhuur</option>
                        <option value="bieding" @if(isset($ad) && $ad->type == "bieding") selected @endif>Bieding</option>
                        <!-- Voeg meer opties toe indien nodig -->
                    </select>
                </div>

                <!-- Verborgen veld om te faken dat we een image al hebben geüpload -->
                <input type="hidden" name="existing_image" id="existing_image" value="{{ $existingImageSrc ?? '' }}">

                <div class="mb-4">
                    <label for="image" class="block text-sm font-bold mb-2">Afbeelding:</label>
                    <label for="image" class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                        <span>Kies bestand</span>
                        <input type="file" class="hidden" id="image" name="image" onchange="previewImage(event)">
                    </label>
                </div>
                <div id="image-preview" class="thumbnail-preview"></div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    @if(isset($ad))
                        Bijwerken
                    @else
                        Opslaan
                    @endif
                </button>
            </form>
        </div>
        <script>

            function previewImage(event) {
                const preview = document.getElementById('image-preview');
                const file = event.target.files[0];
                const reader = new FileReader();
            
                reader.onloadend = function() {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.className = 'w-32 h-32 object-cover';
                    preview.innerHTML = '';
                    preview.appendChild(img);
                };
            
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = '';
                }
            }

            //-- Script toegevoegd waarbij we de preview vullen als er een foto is om te "bewerken"
            document.addEventListener('DOMContentLoaded', function() {
                @php
                    $existingImageSrc = null;
                    if (isset($ad)) {
                        $image = isset($ad['image']) ? json_decode(trim(html_entity_decode($ad['image'])), true) : null;
                        if ($image) {
                            $existingImageSrc = Storage::disk('content_CMS')->url($image['url']);
                        }

                    }
                @endphp

                @if(isset($ad) && $existingImageSrc)
                    const existingImageSrc = @json($existingImageSrc);
                    const imageInput = document.getElementById('existing_image');

                    const preview = document.getElementById('image-preview');
                    const img = document.createElement('img');
                    img.src = existingImageSrc;
                    img.className = 'w-32 h-32 object-cover';
                    preview.appendChild(img);

                    imageInput.value = existingImageSrc;
                @endif

            });

        </script>
</body>
</html>