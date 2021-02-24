<x-app>
    <x-slot name="page_title">Movies</x-slot>

    <!-- si notifications existe et contient au moins 1 notification -->
    @if($notifications && $notifications->count())
    <ul>
        @foreach($notifications as $notification)
            @isset($notification->data['link'])
            <li class="bg-gray-300 py-2 px-4"><a href="{{ $notification->data['link'] }}" class="underlink">{{ $notification->data['title'] }}</a> - {{ $notification->created_at->format('d/m/Y H:i:s') }}</li>
            @endisset
        @endforeach
    </ul>
    @endif

    <a href="{{ route('movie.create') }}" class="align-left focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">
        {{ __('New') }}
    </a>

    <table class="divide-y divide-gray-200 mt-4">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-2 py-3">{{ __('Title') }}</th>
                <th class="text-left px-2 py-3">{{ __('Year') }}</th>
                <th class="text-left px-2 py-3">{{ __('Country') }}</th>
                <th class="text-left px-2 py-3">{{ __('Director') }}</th>
                <th class="text-left px-2 py-3">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white text-xs divide-y divide-gray-200">
            @foreach($movies as $movie)
            <tr>
                <td class="px-2 py-4 flex">
                    @if(file_exists(public_path('/uploads/posters/poster_' . $movie->id . '.jpg')))
                    <img src="{{ url( '/uploads/posters/poster_' . $movie->id . '.jpg' ) }}" class="w-20 mr-2" />
                    @endif
                    {{ $movie->title }}
                </td>
                <td class="px-2 py-4">{{ $movie->year }}</td>
                <td class="px-2 py-4">{{ optional($movie->country)->name }}</td>
                <td class="px-2 py-4">{{ $movie->director ? $movie->director->firstname . ' ' . $movie->director->name : '' }}</td>
                <td class="px-2 py-4">
                    <a href="{{ route('movie.actors', $movie->id) }}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">
                        {{ __('Manage actors') }}
                    </a>

                    <a href="{{ route('movie.edit', $movie->id) }}" class="focus:outline-none text-white text-sm py-2.5 px-5 ml-2 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                        {{ __('Edit') }}
                    </a>

                    <a href="{{ route('movie.destroy', $movie->id) }}" class="delete focus:outline-none text-white text-sm py-2.5 px-5 ml-2 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg">
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $movies->links() }}

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
