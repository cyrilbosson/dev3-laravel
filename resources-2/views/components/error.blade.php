@if($errors->has($name))
<div class="block py-1 px-2 mt-1 text-white bg-red-600 rounded-md">
    {{ $errors->first($name) }}
</div>
@endif
