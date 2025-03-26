<x-app-layout>
  <div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
    <a href="{{ route('projects.index') }}" class="font-bold text-white inline-block mb-4 hover:underline">Back to Projects</a>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-white">{{ $project->name }}</h1>
      <div class="flex space-x-2">
        <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors">
          Edit Project
        </a>
        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block">
          @csrf
          @method('DELETE')
          <button 
            type="submit"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors"  onclick="return confirm('Are you sure you want to delete this project?')"
          >
            Delete Project
          </button>
        </form>
      </div>
    </div>

    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-md p-4 mb-6">
      <div class="flex justify-between items-center border-b border-gray-600 pb-2 mb-4">
        <h2 class="text-xl font-semibold text-gray-200">Project Details</h2>
        
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

      <div class="text-gray-300 space-y-2">
        <p><strong>Description:</strong> {{ $project->description }}</p>
        <div class="flex space-x-4 text-gray-400">
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
          
          @if($project->deadline)
            <span>
              <strong>Deadline:</strong> 
              {{ \Carbon\Carbon::parse($project->deadline)->format('M d, Y') }}
            </span>
          @endif
        </div>
      </div>
    </div>

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold text-white">Tasks</h2>
      <a href="{{ route('projects.tasks.create', ['project' => $project]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
        New Task
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      @forelse($project->tasks as $task)
        <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-md p-4 hover:bg-gray-700 transition-colors h-full flex flex-col">
          <div class="flex justify-between items-center border-b border-gray-600 pb-2 mb-2">
            <h3 class="text-lg font-medium text-white">{{ $task->title }}</h3>
            
            <span class="
              px-2 py-1 rounded-full text-xs font-semibold
              @switch($task->status)
                @case('pending')
                  bg-yellow-900 text-yellow-400
                @break
                @case('in-progress')
                  bg-blue-900 text-blue-400
                @break
                @case('completed')
                  bg-green-900 text-green-400
                @break
                @default
                  bg-gray-700 text-gray-300
              @endswitch
            ">
              {{ ucfirst($task->status) }}
            </span>
          </div>
          
          <p class="text-gray-400 text-sm mb-3 flex-grow">{{ $task->description }}</p>
          
          <div class="text-gray-500 text-xs flex justify-between items-center">
            <div class="flex space-x-3">
              @if($task->priority)
                <span>
                  <strong>Priority:</strong> 
                  <span class="
                    @switch($task->priority)
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
                    {{ ucfirst($task->priority) }}
                  </span>
                </span>
              @endif
              
              @if($task->deadline)
                <span>
                  <strong>Deadline:</strong> 
                  {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                </span>
              @endif
            </div>

            <div class="flex space-x-2">
              <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-2 py-1 rounded-md text-xs transition-colors">
                Edit
              </a>
              <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button
                  type="submit"
                  class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md text-xs transition-colors" 
                  onclick="return confirm('Are you sure you want to delete this task?')"
                >
                  Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center">
          <p class="text-gray-400 mt-6">No tasks for this project yet</p>
        </div>
      @endforelse
    </div>
  </div>
</x-app-layout>