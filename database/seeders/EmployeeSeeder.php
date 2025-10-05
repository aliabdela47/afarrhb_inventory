<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['emp_id' => 'EMP-001', 'name' => 'Ahmed Ali Hassan', 'name_am' => 'አህመድ አሊ ሐሰን', 'department' => 'Health Services', 'position' => 'Doctor'],
            ['emp_id' => 'EMP-002', 'name' => 'Fatima Mohammed', 'name_am' => 'ፋጥማ መሐመድ', 'department' => 'Nursing', 'position' => 'Senior Nurse'],
            ['emp_id' => 'EMP-003', 'name' => 'Ibrahim Yusuf', 'name_am' => 'ኢብራሂም ዩሱፍ', 'department' => 'Laboratory', 'position' => 'Lab Technician'],
            ['emp_id' => 'EMP-004', 'name' => 'Aisha Abdulahi', 'name_am' => 'አይሻ አብዱላሂ', 'department' => 'Pharmacy', 'position' => 'Pharmacist'],
            ['emp_id' => 'EMP-005', 'name' => 'Mohammed Abdi', 'name_am' => 'መሐመድ አብዲ', 'department' => 'Administration', 'position' => 'Administrative Officer'],
            ['emp_id' => 'EMP-006', 'name' => 'Halima Hussein', 'name_am' => 'ሀሊማ ሁሴን', 'department' => 'Finance', 'position' => 'Accountant'],
            ['emp_id' => 'EMP-007', 'name' => 'Abdi Rahman', 'name_am' => 'አብዲ ረሀማን', 'department' => 'IT', 'position' => 'IT Support'],
            ['emp_id' => 'EMP-008', 'name' => 'Zainab Ali', 'name_am' => 'ዘይናብ አሊ', 'department' => 'Human Resources', 'position' => 'HR Officer'],
        ];

        foreach ($employees as $employee) {
            Employee::create([
                'emp_id' => $employee['emp_id'],
                'name' => $employee['name'],
                'name_am' => $employee['name_am'],
                'department' => $employee['department'],
                'position' => $employee['position'],
                'phone' => '+2519' . rand(10000000, 99999999),
                'email' => strtolower(str_replace(' ', '.', $employee['name'])) . '@afarrhb.gov.et',
                'is_active' => true,
            ]);
        }
    }
}
