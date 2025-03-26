<x-app-layout>
  <div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-white text-3xl font-bold">My Projects</h1>
      <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors cursor-pointer">
        New Project
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      @forelse ($projects as $project)
        <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-md p-4 hover:bg-gray-700 transition-colors h-full flex flex-col">
          <div class="flex justify-between items-center border-b border-gray-600 pb-2 mb-2">
            <a href="{{ route('projects.show', $project) }}" class="text-xl font-semibold text-gray-200 hover:text-gray-300 hover:underline">
              {{ $project->name }}
            </a>
            
            {{-- Status Badge --}}
            <span class="
              px-2 py-1 rounded-full text-xs font-semibold
              @switch($project->status)
                @case('pending')
                  bg-yellow-900 text-yellow-400
                @break
                @case('in-progress')
                  bg-blue-900 text-blue-400
                @break
                @case('completed')
                  bg-green-900 text-green-400
                @break
                @case('on-hold')
                  bg-gray-900 text-gray-400
                @break
                @default
                  bg-gray-700 text-gray-300
              @endswitch
            ">
              {{ str_replace('-', ' ', ucfirst($project->status)) }}
            </span>
          </div>

          <p class="text-gray-300 break-words mb-3 flex-grow">{{ $project->description }}</p>

          <div class="flex justify-between text-sm text-gray-400 mb-3">
            <div class="flex items-center space-x-3">
              {{-- Priority --}}
              <span>
                <strong>Priority:</strong>
                <span class="
                  @switch($project->priority)
                    @case('high')
                      text-red-400
                    @break
                    @case('medium')
                      text-yellow-400
                    @break
                    @case('low')
                      text-green-400
                    @break
                  @endswitch
                ">
                  {{ ucfirst($project->priority) }}
                </span>
              </span>

              {{-- Deadline --}}
              @if($project->deadline)
                <span>
                  <strong>Deadline:</strong> 
                  {{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}
                </span>
              @endif
            </div>

            {{-- Task Count --}}
            <span>
              Tasks: {{ $project->tasks_count ?? $project->tasks()->count() }}
            </span>
          </div>

          {{-- Action Buttons --}}
       
            <div class="flex justify-between space-x-2">
              <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md text-xs transition-colors">
                Edit
              </a>
              <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs transition-colors" onclick="return confirm('Are you sure you want to delete this project?')">
                  Delete
                </button>
              </form>
            </div>
     
        </div>
      @empty
        <div class="col-span-full text-center">
          <p class="text-gray-400 mt-6">No Projects for now!</p>
        </div>
      @endforelse
    </div>
  </div>
</x-app-layout>