<?php

namespace Hub\Financial\services\Domain\dtos;

class AuthenticationDto
{
    public string $User = "";
    public string $Password = "";

    public function Encrypt() : void
    {
        $this->Password = md5($this->Password);
    }
}