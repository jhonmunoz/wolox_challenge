<?php

namespace Tests\Unit\UserTest;

use App\Entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	function test_it_can_set_a_user_model()
	{
		$user = new User([
			'id' => 1,
			'name' => 'Luca',
			'email' => 'lpascarelli',
		]);

		$this->assertEquals(1, $user->getId());
		$this->assertEquals('Luca', $user->getName());
		$this->assertEquals('lpascarelli', $user->getEmail());
		$this->assertNull($user->getImage());
	}

	function test_it_can_get_the_image_url()
	{
		$userA = new User([
			'image' => 'avatarA.png',
		]);

		$userB = new User([
			'image' => 'avatarB.png',
		]);

		$this->assertEquals('http://localhost:8080/public/assets/images/users/avatarA.png', $userA->getImageUrl());
		$this->assertEquals('http://localhost:8080/public/assets/images/users/avatarB.png', $userB->getImageUrl());
	}

	function test_it_cannot_get_the_image_url_when_user_dont_have_an_image()
	{
		$user = new User();

		$this->assertNull($user->getImageUrl());
	}
}