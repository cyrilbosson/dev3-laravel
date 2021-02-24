<x-app>
    <x-slot name="page_title">Edit {{ $country->name }}</x-slot>

    <form method="POST" action="{{ route('country.update', $country->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $country->name }}" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="name"></x-error>
        </p>

        <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
            Update
        </button>
    </form>
</x-app>
