<x-app>
    <x-slot name="page_title">Manage actors of movie "{{ $movie->title }}"</x-slot>

    <h1 class="text-xl font-semibold mb-1">Actors</h1>

    <table class="divide-y divide-gray-200 mt-4">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-2 py-3">{{ __('Name') }}</th>
                <th class="text-left px-2 py-3">{{ __('Firstname') }}</th>
                <th class="text-left px-2 py-3">{{ __('Role') }}</th>
                <th class="text-left px-2 py-3">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white text-xs divide-y divide-gray-200">
            @foreach($movie->actors as $artist)
            <tr>
                <td class="px-2 py-4">{{ $artist->name }}</td>
                <td class="px-2 py-4">{{ $artist->firstname }}</td>
                <td class="px-2 py-4">{{ $artist->pivot->role_name }}</td>
                <td class="px-2 py-4">
                    <a href="{{ route('artist.edit', $artist->id) }}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                        {{ __('Edit') }}
                    </a>

                    <a href="{{ route('movie.detach', ['movie' => $movie->id, 'artist' => $artist->id]) }}" class="delete focus:outline-none text-white text-sm py-2.5 px-5 ml-2 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg">
                        {{ __('Detach') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <h1 class="text-xl font-semibold mb-1 mt-20">Add a new actor</h1>

    <form method="POST" action="{{ route('movie.attach', $movie->id) }}">
        {{ csrf_field() }}

        <p>
            <label for="role_name">Role name</label>
            <input type="text" name="role_name" id="role_name" value="" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" />
            <x-error name="role_name"></x-error>
        </p>
        <p>
            <label for="actor_id">Actor</label>
            <select name="actor_id" id="actor_id" required class="block w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                <option value="">{{ __('Select ...') }}</option>
                @foreach($artists as $artist)
                <option value="{{ $artist->id }}">
                    {{ $artist->firstname . ' ' . $artist->name }}
                </option>
                @endforeach
            </select>
            <x-error name="actor_id"></x-error>
        </p>

        <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
            Add
        </button>
    </form>

    <script>
    // Récupération du token
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Ajout des événements
    document.querySelectorAll('.delete').forEach(item => {
      item.addEventListener('click', event => {
        event.preventDefault();

        // Requête AJAX de suppression
        fetch(event.target.href, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
          },
          method: 'DELETE',
        })
        .then((data) => {
            event.target.closest('tr').remove();
        });
      })
    });
    </script>


</x-app>
