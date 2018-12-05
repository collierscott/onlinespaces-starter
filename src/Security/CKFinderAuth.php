<?php

namespace App\Security;

use CKSource\Bundle\CKFinderBundle\Authentication\Authentication as AuthenticationBase;

class CKFinderAuth extends AuthenticationBase
{
    public function authenticate()
    {
        return true;
    }
}