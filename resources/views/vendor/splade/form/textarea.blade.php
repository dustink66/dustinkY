<SpladeTextarea
    {{ $attributes->only(['v-if', 'v-show', 'class']) }}
    :autosize="@js($attributes->has('autosize') ? (bool) $attributes->get('autosize') : $defaultAutosizeValue)"
    v-model="{{ $vueModel() }}"
>
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <textarea {{ $attributes->except(['v-if', 'v-show', 'class', 'autosize'])->class(
            'block bg-white bg-opacity-50 w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 disabled:opacity-50 dark:bg-zinc-700 dark:bg-opacity-80 dark:border-zinc-400 dark:focus:border-green-500 dark:focus:ring-green-500 dark:focus:ring-opacity-50 dark:text-gray-200',
        )->merge([
            'name' => $name,
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ]) }}></textarea>
    </label>

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeTextarea>
