<?php

namespace App\Services\UserService;

/**
 * Interface IUserService
 * @author Alberto Almazan
 */
interface IUserService
{
	public function login(string $email, string $password);
	public function logout();
}
