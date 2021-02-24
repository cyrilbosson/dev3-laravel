<x-app>
    <x-slot name="page_title">Create a movie</x-slot>

    <form method="POST" action="{{ route('movie.store') }}">
        {{ csrf_field() }}
        <p>
            <label for="name">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="title"></x-error>
        </p>
        <p>
            <label for="year">Year</label>
            <input type="text" name="year" id="year" value="{{ old('year') }}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="year"></x-error>
        </p>
        <p>
            <label for="country_id">Country</label>
            <select name="country_id" id="country_id" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                @foreach($countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
                @endforeach
            </select>
            <x-error name="country_id"></x-error>
        </p>
        <p>
            <label for="director_id">Director</label>
            <select name="director_id" id="director_id" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                <option value="">{{ __('Select ...') }}</option>
                @foreach($artists as $artist)
                <option value="{{ $artist->id }}">
                    {{ $artist->firstname . ' ' . $artist->name }}
                </option>
                @endforeach
            </select>
            <x-error name="director_id"></x-error>
        </p>

        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light py-3 px-4 text-xl leading-tight">Create</button>
    </form>
</x-app>
