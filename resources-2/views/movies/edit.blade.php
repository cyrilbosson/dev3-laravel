<x-app>
    <x-slot name="page_title">Edit {{ $movie->title }}</x-slot>

    <form method="POST" action="{{ route('movie.update', $movie->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <p>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="title"></x-error>
        </p>
        <p>
            <label for="year">Year</label>
            <input type="text" name="year" id="year" value="{{ $movie->year }}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="year"></x-error>
        </p>
        <p>
            <label for="country_id">Country</label>
            <select name="country_id" id="country_id" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ $country->id === $movie->country_id ? 'selected="selected"' : '' }}>
                    {{ $country->name }}
                </option>
                @endforeach
            </select>
            <x-error name="country_id"></x-error>
        </p>
        <p>
            <label for="director_id">Director</label>
            <select name="director_id" id="director_id" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                <option value="">{{ __('Select ...') }}</option>
                @foreach($artists as $artist)
                <option value="{{ $artist->id }}" {{ $artist->id === $movie->director_id ? 'selected="selected"' : '' }}>
                    {{ $artist->firstname . ' ' . $artist->name }}
                </option>
                @endforeach
            </select>
            <x-error name="director_id"></x-error>
        </p>

        <p>
            <label for="poster">Poster</label>
            <input type="file" name="poster" value="" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
        </p>

        <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
            Update
        </button>
    </form>
</x-app>
