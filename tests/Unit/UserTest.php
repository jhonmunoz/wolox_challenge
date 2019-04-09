<?php

namespace Tests\Unit\UserTest;

use App\Entities\User;
use App\Helpers\Helper;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_it_can_set_a_user_model()
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

    public function test_it_can_get_the_image_url()
    {
        $helper = new Helper();
        $userA = new User([
            'image' => 'avatarA.png',
        ]);

        $userB = new User([
            'image' => 'avatarB.png',
        ]);

        $this->assertEquals('http://localhost:8080/public/assets/images/users/avatarA.png', $userA->getImageUrl($helper->getServerHost()));
        $this->assertEquals('http://localhost:8080/public/assets/images/users/avatarB.png', $userB->getImageUrl($helper->getServerHost()));
    }

    public function test_it_cannot_get_the_image_url_when_user_dont_have_an_image()
    {
        $helper = new Helper();
        $user = new User();

        $this->assertNull($user->getImageUrl($helper->getServerHost()));
    }
}
