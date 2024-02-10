<?php

declare(strict_types=1);

namespace Siroko\Infrastructure\User\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Siroko\Application\User\Auth\AuthUserDTO;
use Siroko\Application\User\Auth\CreateUserToken;
use Siroko\Application\User\Auth\UserAuthenticator;
use Siroko\Domain\Encryptor\Encryptor;
use Siroko\Domain\Exceptions\AuthUserException;
use Siroko\Domain\Exceptions\InvalidUuidException;

class AuthUserController
{
    public function __construct(
        private readonly UserAuthenticator $userAuthenticator,
        private readonly CreateUserToken   $createAuthToken,
        private readonly Encryptor         $encryptor
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/user/auth",
     *     summary="Authenticates user",
     *     description="Returns a User",
     *     operationId="authUser",
     *     tags={"User"},
     *     @OA\Parameter(
     *         description="Email to use for login",
     *         in="data",
     *         name="email",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="varchar"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Password to use for login",
     *         in="data",
     *         name="password",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="varchar"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User authenticated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="code",
     *                 type="integer",
     *                 description="Response code"
     *            ),
     *            @OA\Property(
     *                property="msg",
     *                type="string",
     *                description="Response message"
     *            ),
     *            @OA\Property(
     *               type="object",
     *               property="data",
     *               @OA\Property(
     *                   property="token",
     *                   type="string",
     *                   description="Auth token"
     *              ),
     *           ),
     *        ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid input data (email or password empty)"
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Invalid password"
     *      ),
     *     @OA\Response(
     *          response="406",
     *          description="Invalid format email"
     *      ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     * @throws InvalidUuidException
     */

    public function __invoke(Request $request): JsonResponse
    {
        $payload = $request->json();

        $email = $payload->get('email');
        $password = $payload->get('password');

        try {
            $this->ensureNotEmpty($email);
            $this->ensureNotEmpty($password);
            $this->ensureEmailIsValid($email);
        } catch (AuthUserException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }

        try {
            $user = $this->userAuthenticator->__invoke(new AuthUserDTO($email));
            $encryptedPassword = $user->getPassword();
            $this->ensureNotEmpty($encryptedPassword);
            $this->ensurePasswordIsCorrect($password, $encryptedPassword);
        } catch (AuthUserException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }

        $token = $this->createAuthToken->__invoke($user->getUserUuid());

        return response()->json([
            'code' => 200,
            'msg' => 'User authenticated successfully',
            'data' => [
                'token' => $token
            ]
        ], 200);
    }


    //TODO: Sacar los ensure fuera del controller

    /**
     * @throws AuthUserException
     */
    private function ensureNotEmpty($var): void
    {
        if (empty($var)) {
            throw new AuthUserException(
                sprintf('<%s> does not allow empty variable', UserAuthenticator::class),
                400
            );
        }
    }

    /**
     * @throws AuthUserException
     */
    private function ensureEmailIsValid(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new AuthUserException(
                sprintf('<%s> does not allow invalid format email', UserAuthenticator::class),
                406
            );
        }
    }

    /**
     * @throws AuthUserException
     */
    private function ensurePasswordIsCorrect($plainPassword, $encryptedPassword): void
    {
        if (!$this->encryptor->verifyEncrypt($plainPassword, $encryptedPassword)) {
            throw new AuthUserException(
                sprintf('<%s> does not allow invalid password', UserAuthenticator::class),
                401
            );
        }
    }
}
