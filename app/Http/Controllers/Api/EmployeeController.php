<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmployeeRepository;
use App\Http\Requests\EmployeeCreateRequest;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * @OA\Get(
     * path="/api/employees/{company_id}",
     * summary="Get all Employees",
     * description="Get all employees of one company by company ID , this route worked  for admin and company roles.",
     * operationId="getEmployees",
     * tags={"Employees"},
     * security={
     *         {"bearer": {}}
     *     },
     *  @OA\Parameter(
     *     name="company_id",
     *     description="Company id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="integer"
     *     )
     * ),
     * @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Company")
     *       ),
    * @OA\Response(
    *     response=401,
    *     description="Unauthenticated",
    * ),
    * @OA\Response(
    *     response=403,
    *     description="Forbidden"
    * ),
    * @OA\Response(
    *     response=404,
    *     description="Resource Not Found"
    * )
     * )
     */
    public function allEmployees($id)
    {
        return $this->employeeRepository->allEmployees($id);
    }

    /**
     * @OA\Get(
     * path="/api/employee/{employee_id}",
     * summary="Get employee by ID",
     * description="Get one employee with ID, this route worked for admin and company roles.",
     * operationId="getemployee",
     * tags={"Employees"},
      * security={
     *         {"bearer": {}}
     *     },
     *  @OA\Parameter(
     *     name="employee_id",
     *     description="Employee id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="integer"
     *     )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Employee")
     *  ),
    * @OA\Response(
    *     response=401,
    *     description="Unauthenticated",
    * ),
    * @OA\Response(
    *     response=403,
    *     description="Forbidden"
    * ),
    * @OA\Response(
    *     response=404,
    *     description="Resource Not Found"
    * )
     * )
     */
    public function getEmployee($id)
    {
        return $this->employeeRepository->getEmployee($id);
    }

    /**
     * @OA\Post(
     * path="/api/employee/create",
     * summary="Create employee",
     * description="Create employee, this route worked only for admin and company roles.",
     * operationId="addEmployee",
     * tags={"Employees"},
       * security={
     *         {"bearer": {}}
     *     },
     *  @OA\RequestBody(
     *    required=true,
     *    description="Create employee",
     *    @OA\JsonContent(
     * required={"passport_serial","first_name","address","father_name","last_name","position","phone","company_id"},
     *      @OA\Property(property="passport_serial", type="string", format="text", example="AA777999"),
     *      @OA\Property(property="first_name", type="string", format="text", example="Oliver"),
     *      @OA\Property(property="last_name", type="string", format="text", example="Jake"),
     *      @OA\Property(property="father_name", type="string", format="text", example="Mike"),
     *      @OA\Property(property="position", type="string", format="text", example="Manager"),
     *      @OA\Property(property="address", type="string", format="text", example="Uzbekistan Tashkent region, Parkent town"),
     *      @OA\Property(property="phone", type="number", format="number", example="3333333333"),
     *      @OA\Property(property="company_id", type="number", format="number", example="3"),
     *    ),
     * ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Employee")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Company")
     *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Resource Not Found"
    *      )
     * )
     */
    public function create(EmployeeCreateRequest $request)
    {
        return $this->employeeRepository->create($request);
    }

    /**
     * @OA\Put(
     * path="/api/employee/update/{employee_id}",
     * summary="Get employee by ID",
     * description="Update employee with ID, this route worked for admin and company roles.",
     * operationId="updateEmployee",
     * tags={"Employees"},
      * security={
     *         {"bearer": {}}
     *     },
     *  @OA\Parameter(
     *          name="employee_id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\RequestBody(
     *    required=true,
     *    description="Create employee",
     *    @OA\JsonContent(
     * required={"passport_serial","first_name","address","father_name","last_name","position","phone","company_id"},
     *      @OA\Property(property="passport_serial", type="string", format="text", example="AA777999"),
     *      @OA\Property(property="first_name", type="string", format="text", example="Oliver"),
     *      @OA\Property(property="last_name", type="string", format="text", example="Jake"),
     *      @OA\Property(property="father_name", type="string", format="text", example="Mike"),
     *      @OA\Property(property="position", type="string", format="text", example="Manager"),
     *      @OA\Property(property="address", type="string", format="text", example="Uzbekistan Tashkent region, Parkent town"),
     *      @OA\Property(property="phone", type="number", format="number", example="3333333333"),
     *      @OA\Property(property="company_id", type="number", format="number", example="3"),
     *    ),
     * ),
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Employee")
     * ),
     * @OA\Response(
     *     response=202,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Employee")
     *  ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Resource Not Found"
    *      )
     * )
     */
    public function update(Request $request,$id)
    {
        return $this->employeeRepository->updateEmployee($request,$id);
    }

    /**
     * @OA\Delete(
     * path="/api/employee/delete/{employee_id}",
     * summary="Delete employee by ID",
     * description="Delete employee with ID, this route worked only for admin and company roles.",
     * operationId="deleteEmployee",
     * tags={"Employees"},
     * security={
     *         {"bearer": {}}
     *     },
     *  @OA\Parameter(
     *       name="employee_id",
     *       description="Employee id",
     *       required=true,
     *       in="path",
     *       @OA\Schema(
     *           type="integer"
     *       )
     *   ),
    *   @OA\Response(
    *       response=204,
    *       description="Successful operation",
    *       @OA\JsonContent()
    *    ),
    *   @OA\Response(
    *       response=401,
    *       description="Unauthenticated",
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Resource Not Found"
    *   )
     * )
     */
    public function delete($id)
    {
        return $this->employeeRepository->delete($id);
    }
}
