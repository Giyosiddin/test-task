<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @OA\Get(
     * path="/api/companies",
     * summary="Get all companies",
     * description="Get all companies, this route worked only for admin role.",
     * operationId="getCompanies",
     * tags={"Company"},
     * security={
     *         {"bearer": {}}
     *     },
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
    public function allCompany()
    {
        return $this->companyRepository->allCompany();
    }
    /**
     * @OA\Get(
     * path="/api/company/{company_id}",
     * summary="Get company by ID",
     * description="Get one company with ID, this route worked only for admin role.",
     * operationId="getCompany",
     * tags={"Company"},
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
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Company")
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
    public function getcompany($id)
    {
        return $this->companyRepository->getcompany($id);
    }

    /**
     * @OA\Post(
     * path="/api/company/create",
     * summary="Create company",
     * description="Create company, this route worked only for admin role.",
     * operationId="addCompany",
     * tags={"Company"},
       * security={
     *         {"bearer": {}}
     *     },
     *  @OA\RequestBody(
     *    required=true,
     *    description="Create company",
     *    @OA\JsonContent(
     * required={"company_name","supervisor","address","email","website","phone","manager_id"},
     *      @OA\Property(property="company_name", type="string", format="text", example="Company name"),
     *      @OA\Property(property="supervisor", type="string", format="text", example="Oliver Jake "),
     *      @OA\Property(property="address", type="string", format="text", example="Uzbekistan Tashkent region, Parkent town"),
     *      @OA\Property(property="email", type="string", format="text", example="test@gmail.com"),
     *      @OA\Property(property="website", type="string", format="text", example="https://www.google.com/"),
     *      @OA\Property(property="phone", type="number", format="number", example="3333333333"),
     *      @OA\Property(property="manager_id", type="number", format="number", example="3"),
     *    ),
     * ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Company")
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
    public function create(CompanyCreateRequest $request)
    {
        return $this->companyRepository->create($request);
    }

    /**
     * @OA\Put(
     * path="/api/company/update/{company_id}",
     * summary="Get company by ID",
     * description="Update company with ID, this route worked only for admin role.",
     * operationId="updateCompany",
     * tags={"Company"},
      * security={
     *         {"bearer": {}}
     *     },
     *  @OA\Parameter(
     *          name="company_id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\RequestBody(
     *    required=true,
     *    description="Update company",
     *    @OA\JsonContent(
     *      required={"company_name","supervisor","address","email","website","phone","manager_id"},
     *      @OA\Property(property="company_name", type="string", format="text", example="Company name"),
     *      @OA\Property(property="supervisor", type="string", format="text", example="Oliver Jake "),
     *      @OA\Property(property="address", type="string", format="text", example="Uzbekistan Tashkent region, Parkent town"),
     *      @OA\Property(property="email", type="string", format="text", example="test@gmail.com"),
     *      @OA\Property(property="website", type="string", format="text", example="https://www.google.com/"),
     *      @OA\Property(property="phone", type="number", format="number", example="3333333333"),
     *      @OA\Property(property="manager_id", type="number", format="number", example="3"),
     *    ),
     * ),
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Company")
     * ),
     * @OA\Response(
     *     response=202,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Company")
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
    public function update(CompanyUpdateRequest $request,$id)
    {
        return $this->companyRepository->update($request,$id);
    }

    /**
     * @OA\Delete(
     * path="/api/company/delete/{company_id}",
     * summary="Delete company by ID",
     * description="Delete company with ID, this route worked only for admin role.",
     * operationId="deleteCompany",
     * tags={"Company"},
     * security={
     *         {"bearer": {}}
     *     },
     *  @OA\Parameter(
     *       name="company_id",
     *       description="Company id",
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
        return $this->companyRepository->delete($id);
    }
}
