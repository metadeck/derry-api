<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\ApiRefreshTokenRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Repositories\UserRepository;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use JWTAuth;
use JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AuthController extends BaseController {

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ApiUserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();

            try {
                $token = JWTAuth::fromUser($user);
            } catch (JWTException $e) {
                return $this->sendError("Unable to get token for user.", Response::HTTP_UNAUTHORIZED);
            }

            $user->load('profile');

            return $this->sendResponse(["token" => $token, "user" => $user], "Successfully logged in");

        } else {
            return $this->sendError("User not found.", Response::HTTP_NOT_FOUND);
        }

    }

    public function register(ApiRegisterRequest $request)
    {
        //create the new user
        $input["email"] = $request->email;
        $input["password"] = bcrypt($request->password);
        $input["first_name"] = $request->first_name;
        $input["last_name"] = $request->last_name;
        $input["terms_and_policy"] = true;
        $input["role"] = "appuser";
        $user = $this->userRepository->create($input);

        if(!$user){
            return $this->sendError("Unable to create user.", Response::HTTP_BAD_REQUEST);
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (TokenBlacklistedException $e) {
            return $this->sendError("Token blacklisted. Refresh token now.", Response::HTTP_FORBIDDEN);
        }catch (TokenExpiredException $e) {
            return $this->sendError("Token expired. Refresh token now.", Response::HTTP_FORBIDDEN);
        } catch (TokenInvalidException $e) {
            return $this->sendError("Token invalid. Refresh token now.", Response::HTTP_FORBIDDEN);
        } catch (JWTException $e) {
            return $this->sendError("Unable to get token for user.", Response::HTTP_FORBIDDEN);
        }

        return $this->sendResponse(["token" => $token, "user" => $user], "Successfully logged in");
    }

    public function refreshToken(ApiRefreshTokenRequest $request){
        try {
            $token = JWTAuth::refresh($request->token);
        } catch (JWTException $e) {
            return $this->sendError("Unable to refresh token", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->sendResponse(["token" => $token], "Successfully refreshed token");
    }
}
