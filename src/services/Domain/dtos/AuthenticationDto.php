<?php

namespace Hub\Financial\services\Domain\dtos;

class AuthenticationDto
{
    public string $user = "";
    public string $password = "";

    public function Encrypt() : void
    {
        $this->password = md5($this->password);
    }
}