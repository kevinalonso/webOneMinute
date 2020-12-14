<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class AdminController extends EasyAdminController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    private function encodeUserPlainPassword($user)
    {
        if (property_exists($user, 'getPassword()')) {
            $plainPassword = $user->getPassword();

            if (!empty($plainPassword)) {
                $encoded = $this->passwordEncoder->encodePassword($user, $plainPassword);
                $user->setPassword($encoded);
            }
        }
    }

    public function persistEntity($user)
    {
        $this->encodeUserPlainPassword($user);
        parent::persistEntity($user);
    }

    public function updateEntity($user)
    {
        $this->encodeUserPlainPassword($user);
        parent::updateEntity($user);
    }
}