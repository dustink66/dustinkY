@if($name)<p class="text-red-600 text-sm mt-2" v-if="form.hasError(@js($name))" v-bind="form.$errorAttributes(@js($name))" />@endif
