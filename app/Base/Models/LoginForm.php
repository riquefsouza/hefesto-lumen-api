<?php

namespace App\Base\Models;

class LoginForm implements \JsonSerializable
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    public function __construct(array $json)
    {
        $this->login = $json["login"];
        $this->password = $json["password"];
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'login' => $this->getLogin(),
            'password' => $this->getPassword()
        ];
    }
}
