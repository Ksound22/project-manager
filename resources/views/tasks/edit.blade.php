<x-app-layout>
  <h1 class="text-3xl text-gray-100 font-bold text-center mt-3">Edit Task: {{ $task->title }}, for Project: {{$project->name}}</h1>

  <div class="max-w-md mx-auto mt-6 px-4 py-6 bg-gray-800 border border-gray-700 rounded-lg shadow-md">
    <form action="{{ route('tasks.update', $task) }}" method="POST">
      @csrf
      @method('PUT')
      <div>
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title', $task->title) }}" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="description" :value="__('Description')" />
        <x-textarea id="description" name="description" rows="5" cols="47" placeholder="Enter your description...">{{ old('description', $task->description) }}</x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="priority" :value="__('Priority')" />
        <x-select id="priority" name="priority" :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']" selected="medium" :selected="old('priority', $task->priority)" />
        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="status" :value="__('Status')" />
        <x-select id="status" name="status" :options="['pending' => 'Pending', 'in-progress' => 'In Progress', 'completed' => 'Completed', 'on-hold' => 'On Hold']" :selected="old('status', $task->status)" />
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
      </div>

      <div class="mt-4">
        <x-input-label for="date" :value="__('Deadline')" />
        <x-date-input id="date" name="deadline" name="deadline" value="{{ old('deadline', $project->deadline) }}" />
        <x-input-error :messages="$errors->get('date')" class="mt-2" />
      </div>

       <div class="flex items-center justify-start mt-4">
          <x-full-width-button class="bg-indigo-600 text-white hover:bg-indigo-700">
            {{ __('Update Task') }}
          </x-full-width-button>
        </div>
    </form>
  </div>

</x-app-layout>