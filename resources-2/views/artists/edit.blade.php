<x-app>
    <x-slot name="page_title">Edit {{ $artist->firstname . ' ' . $artist->name }}</x-slot>

    <form method="POST" action="{{ route('artist.update', $artist->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $artist->name }}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="name"></x-error>
        </p>
        <p>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname" value="{{ $artist->firstname }}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="firstname"></x-error>
        </p>
        <p>
            <label for="birthdate">Birthdate</label>
            <input type="text" name="birthdate" id="birthdate" value="{{ $artist->birthdate }}" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="birthdate"></x-error>
        </p>
        <p>
            <label for="country_id">Country</label>
            <select name="country_id" id="country_id" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ $country->id === $artist->country_id ? 'selected="selected"' : '' }}>
                    {{ $country->name }}
                </option>
                @endforeach
            </select>
            <x-error name="country_id"></x-error>
        </p>

        <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
            Update
        </button>
    </form>
</x-app>
