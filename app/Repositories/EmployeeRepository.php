<?php

namespace App\Repositories;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseApi;
use App\Models\Employee;
use App\Models\Company;

class EmployeeRepository
{
    use ResponseApi;

    public function allEmployees($company_id)
    {
        $company = Company::with('employees','employees.company')->findOrFail($company_id);
        return $this->success('Get all employees of this company!',$company->employees,200);
    }
    public function getEmployee($id)
    {
        $employee = Employee::with('company')->findOrFail($id);
        return $this->success('Get employee with id!',$employee,200);
    }
    public function create($request)
    {
        $data = $request->all();
        $newEmployee = Employee::create($data);
        return $this->success('Employee is ctreated successfully!', $newEmployee);
    }
    public function updateEmployee($request,$id)
    {
        $employee = Employee::findOrFail($id);
        $data = $request->all();
        $employee->update($data);
        return $this->success('Employee is updated successfully!', $employee);
    }
    public function delete($id)
    {
        $delete = Employee::destroy($id);
        return $this->success('Employee is deleted successfully!', $delete);
    }

}
