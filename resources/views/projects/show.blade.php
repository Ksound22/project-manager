<x-app-layout>
  <div class="max-w-xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white mb-6">{{ $project->name }}</h1>
    
    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-md p-4 mb-4">
      <h2 class="text-xl font-semibold text-gray-200 border-b border-gray-600 pb-2 mb-4">Tasks</h2>
      
      @forelse($project->tasks as $task)
        <div class="bg-gray-900 rounded-lg p-4 flex items-start justify-between mb-3 last:mb-0">
          <div class="flex-grow mr-4">
            <div class="flex items-center mb-2">
              <h3 class="text-lg font-medium text-white mr-3">{{ $task->title }}</h3>
              
              <span class="
                px-2 py-1 rounded-full text-xs font-semibold
                @switch($task->status)
                  @case('pending')
                    bg-yellow-900 text-yellow-400
                  @break
                  @case('in_progress')
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
            
            <p class="text-gray-400 text-sm mb-2">{{ $task->description }}</p>
            
            <div class="text-gray-500 text-xs flex space-x-4">
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
          </div>
        </div>
      @empty
        <p class="text-gray-400 text-center py-4">No tasks for this project yet for now</p>
      @endforelse
    </div>
  </div>
</x-app-layout>