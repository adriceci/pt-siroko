<?php

declare(strict_types=1);

namespace Tests\Unit\Application\User;

use PHPUnit\Framework\MockObject\Exception;
use Siroko\Application\User\Auth\AuthUserDTO;
use Siroko\Application\User\Auth\CreateUserToken;
use Siroko\Application\User\Auth\UserAuthenticator;
use Siroko\Domain\Exceptions\AuthUserException;
use Siroko\Domain\Exceptions\InvalidUuidException;
use Siroko\Domain\User\User;
use Siroko\Domain\User\UserRepository;
use Siroko\Shared\Uuid;
use Tests\TestCase;

final class UserTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidUuidException
     */
    public function test_it_return_200_when_create_auth_token(): void
    {

        $userUuid = Uuid::random();

        $repository = $this->createMock(UserRepository::class);
        $repository->expects($this->once())->method('createAuthToken');
        $userAuth = new CreateUserToken($repository);
        $userAuth->__invoke($userUuid->value());
    }

    /**
     * @throws Exception
     * @throws AuthUserException
     */
    public function test_it_return_200_when_user_found(): void
    {
        $authUserDTO = new AuthUserDTO(
            email: 'test@siroko.com',
        );

        $repository = $this->createMock(UserRepository::class);
        $repository->method('searchByEmail')->willReturn(new User([]));
        $userAuth = new UserAuthenticator($repository);
        $this->assertInstanceOf(User::class, $userAuth->__invoke($authUserDTO));
        $userAuth->__invoke($authUserDTO);
    }

    /**
     * @throws Exception
     */
    public function test_it_return_404_when_user_not_found(): void
    {
        $authUserDTO = new AuthUserDTO(
            email: fake()->email(),
        );

        $repository = $this->createMock(UserRepository::class);
        $repository->method('searchByEmail')->willReturn(null);
        $userAuth = new UserAuthenticator($repository);
        $this->expectException(AuthUserException::class);
        $userAuth->__invoke($authUserDTO);
    }

}
