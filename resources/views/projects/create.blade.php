<x-app-layout>
  <h1 class="text-3xl text-gray-100 font-bold text-center mt-3">Create a Project</h1>
  <div class="max-w-md mx-auto mt-6 px-4 py-6 bg-gray-800 border border-gray-700 rounded-lg shadow-md">
    <form action="">
      <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="description" :value="__('Description')" />
        <x-textarea id="description" name="description" rows="5" cols="47" placeholder="Enter your description..." />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="status" :value="__('Status')" />
        <x-select id="status" name="status" :options="['pending' => 'Pending', 'in-progress' => 'In Progress', 'completed' => 'Completed', 'on-hold' => 'On Hold']" selected="pending" />
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="priority" :value="__('Priority')" />
        <x-select id="priority" name="priority" :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']" selected="medium" />
        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="date" :value="__('Date')" />
        <x-date-input id="date" name="deadline" />
        <x-input-error :messages="$errors->get('date')" class="mt-2" />
      </div>

       <div class="flex items-center justify-start mt-4">
          <x-full-width-button class="bg-indigo-600 text-white hover:bg-indigo-700">
            {{ __('Create') }}
          </x-full-width-button>
        </div>
    </form>
  </div>
</x-app-layout>