<x-app-layout>
  <div class="max-w-xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
    <h1 class="text-white text-3xl font-bold  mb-6">My Projects</h1>

    @forelse ($projects as $project)
      <a href="{{ route('projects.show', $project) }}"  class="bg-gray-800 border border-gray-700 rounded-lg inline-block shadow-md p-4 mb-4 max-w-xl w-full">
        <div class="border-b border-gray-600 pb-2 mb-2">
          <h2 class="text-xl font-semibold text-gray-200">
            {{ $project->name }}
          </h2>
        </div>
        <p class="text-gray-200 break-words">{{ $project->description }}</p>
      </a>
    @empty
      <div class="text-center">
        <p class="text-gray-400 mt-6">No Projects for now!</p>
      </div>
    @endforelse
  </div>
</x-app-layout>