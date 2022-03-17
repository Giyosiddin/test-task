<?php

namespace App\Repositories;

use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\LoginUserRequest;
use App\Traits\ResponseApi;
use App\Models\Company;

class CompanyRepository
{
    use ResponseApi;

    public function allCompany()
    {
        $companies = Company::with('employees')->get();
        return $this->success('Get all companies with their employees!', $companies);
    }

    public function getcompany($id)
    {
        $company = Company::with('employees')->findOrFail($id);
        return $this->success('Get company with id!',$company,200);
    }

    public function create($request)
    {
        $data = $request->all();
        $newCompany = Company::create($data);
        return $this->success('Company is ctreated successfully!', $newCompany);
    }

    public function update($request, $id)
    {
        $company = Company::findOrFail($id);
        $data = $request->all();
        $company->update($data);
        return $this->success('Company is updated successfully!', $company);
    }

    public function delete($id)
    {
        $delete = Company::destroy($id);
        return $this->success('Company is deleted successfully!', $delete);
    }
}
