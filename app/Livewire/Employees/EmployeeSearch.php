<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;

class EmployeeSearch extends Component
{
    public $search = '';
    public $selectedEmployee = null;
    public $employees = [];
    public $showDropdown = false;

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->employees = Employee::where('is_active', true)
                ->where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('emp_id', 'like', '%' . $this->search . '%')
                          ->orWhere('department', 'like', '%' . $this->search . '%');
                })
                ->limit(10)
                ->get();
            $this->showDropdown = true;
        } else {
            $this->employees = [];
            $this->showDropdown = false;
        }
    }

    public function selectEmployee($employeeId)
    {
        $employee = Employee::find($employeeId);
        if ($employee) {
            $this->selectedEmployee = $employee;
            $this->search = $employee->name . ' (' . $employee->emp_id . ')';
            $this->showDropdown = false;
            $this->dispatch('employee-selected', employeeId: $employeeId);
        }
    }

    public function clearSelection()
    {
        $this->selectedEmployee = null;
        $this->search = '';
        $this->employees = [];
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.employees.employee-search');
    }
}
