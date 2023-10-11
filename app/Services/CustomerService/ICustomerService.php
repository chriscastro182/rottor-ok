<?php

namespace App\Services\CustomerService;

interface ICustomerService
{
	public function login(string $email, string $password);
	public function getByEmail(string $email);
}
