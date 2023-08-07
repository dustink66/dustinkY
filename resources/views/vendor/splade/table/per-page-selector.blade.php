<select
    name="per_page"
    class="block bg-white bg-opacity-70 dark:bg-zinc-900 dark:bg-opacity-70 dark:text-gray-200 focus:ring-green-500 focus:border-green-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"
    @change="table.updateQuery('perPage', $event.target.value)"
  >
    @foreach($table->allPerPageOptions() as $perPage)
        <option value="{{ $perPage }}" @selected($perPage === $table->perPage())>
            {{ $perPage }} {{ __('per page') }}
        </option>
    @endforeach
</select>
