<x-app>
    <x-slot name="page_title">Create an artist</x-slot>

    <form method="POST" action="{{ route('artist.store') }}">
        {{ csrf_field() }}
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="name"></x-error>
        </p>
        <p>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname" value="" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="firstname"></x-error>
        </p>
        <p>
            <label for="birthdate">Birthdate</label>
            <input type="text" name="birthdate" id="birthdate" value="" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="birthdate"></x-error>
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

        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light py-3 px-4 text-xl leading-tight">Create</button>
    </form>
</x-app>
