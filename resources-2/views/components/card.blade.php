<div class="flex items-center">
    {{ $icon }}
    <div class="ml-4 text-lg leading-7 font-semibold">

    @isset($url)
    <a href="{{ $url }}" class="underline text-gray-900 dark:text-white">
    @endisset

    {{ $title }}

    @isset($url)
    </a>
    @endisset

    </div>
</div>

<div class="ml-12">
    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        {{ $slot }}
    </div>
</div>
