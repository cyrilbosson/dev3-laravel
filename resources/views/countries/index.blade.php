<x-app>
    <x-slot name="page_title">Countries</x-slot>

    <a href="{{ route('country.create') }}" class="align-left focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">
        {{ __('New') }}
    </a>

    <table class="divide-y divide-gray-200 mt-4">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-2 py-3">{{ __('Name') }}</th>
                <th class="text-left px-2 py-3">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white text-xs divide-y divide-gray-200">
            @foreach($countries as $country)
            <tr>
                <td class="px-2 py-4">{{ $country->name }}</td>
                <td class="px-2 py-4">
                    <a href="{{ route('country.edit', $country->id) }}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                        {{ __('Edit') }}
                    </a>

                    <a href="{{ route('country.destroy', $country->id) }}" class="delete focus:outline-none text-white text-sm py-2.5 px-5 ml-2 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg">
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $countries->links() }}

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
