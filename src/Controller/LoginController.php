<?php

namespace App\Controller;

use App\Annotation\ControllerMapping;
use App\Annotation\RequestBodyVariable;
use App\Annotation\RequestMapping;
use App\Service\LoginService;

/**
 * @ControllerMapping(classMapping="/login")
 */
class LoginController implements Controller
{
    private LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    /**
     * @param string $userData
     * @return string
     *
     * @RequestMapping(method="POST", path="/login")
     * @RequestBodyVariable(variableName="userData")
     */
    public function authenticate(string $userData): string
    {
        return json_encode($this->loginService->login($userData));
    }
}
