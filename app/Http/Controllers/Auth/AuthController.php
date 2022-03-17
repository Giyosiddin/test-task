<?php

namespace App\Http\Controllers\Auth;

use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\NewUserRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @OA\Post(
     * path="/api/register",
     * summary="Sign Up",
     * description="Register by name, email, password",
     * operationId="register",
     * tags={"Auth"},
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Parameter(
     *     name="password",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
    *     )
    *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong details for register. Please try again")
     *        )
     *     )
     * )
     */
    public function register(NewUserRequest $request)
    {
        return $this->userRepository->register($request);
    }
      /**
     * @OA\Post(
     * path="/api/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"Auth"},
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *  ),
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
    *     )
    *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function login(LoginUserRequest $request)
    {
        return $this->userRepository->login($request);
    }
    /**
     * @OA\Get(
     * path="/api/logout",
     * summary="Logout",
     * description="Logout user and invalidate token",
     * operationId="authLogout",
     * tags={"Auth"},
     * security={{"bearer":{}}},
     * @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * )
     * )
     */

    public function logout(Request $request)
    {
        return $this->userRepository->logout($request);
    }
}
