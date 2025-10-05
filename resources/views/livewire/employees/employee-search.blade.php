<div class="relative">
    <label class="form-label">
        {{ app()->getLocale() === 'am' ? 'ሰራተኛ ይፈልጉ' : 'Search Employee' }}
    </label>
    
    <div class="relative">
        <input 
            type="text" 
            wire:model.live="search" 
            class="form-input pr-10"
            placeholder="{{ app()->getLocale() === 'am' ? 'ስም ወይም መታወቂያ ያስገቡ' : 'Enter name or ID' }}"
            autocomplete="off"
        >
        
        @if($selectedEmployee)
            <button 
                type="button"
                wire:click="clearSelection" 
                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif
    </div>

    @if($showDropdown && count($employees) > 0)
        <div class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
            @foreach($employees as $employee)
                <div 
                    wire:click="selectEmployee({{ $employee->id }})"
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-100 last:border-b-0">
                    <div class="font-semibold text-gray-900">{{ $employee->name }}</div>
                    <div class="text-sm text-gray-600">
                        {{ app()->getLocale() === 'am' ? 'መታወቂያ' : 'ID' }}: {{ $employee->emp_id }} | 
                        {{ app()->getLocale() === 'am' ? 'ክፍል' : 'Dept' }}: {{ $employee->department }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($selectedEmployee)
        <div class="mt-2 p-3 bg-green-50 border border-green-200 rounded-md">
            <div class="font-semibold text-green-900">{{ $selectedEmployee->name }}</div>
            <div class="text-sm text-green-700">
                {{ app()->getLocale() === 'am' ? 'መታወቂያ' : 'ID' }}: {{ $selectedEmployee->emp_id }} | 
                {{ app()->getLocale() === 'am' ? 'ክፍል' : 'Department' }}: {{ $selectedEmployee->department }} | 
                {{ app()->getLocale() === 'am' ? 'የስራ መደብ' : 'Position' }}: {{ $selectedEmployee->position }}
            </div>
        </div>
    @endif
</div>
