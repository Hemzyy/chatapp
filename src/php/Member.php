<?php 

class Member {
    private int $id;
    private string $username;
    private string $email;
    private string $password;

    public function __construct(array $info) {
        $this->id = $info['id'];
        $this->username = $info['username'];
        $this->email = $info['email'];
        $this->password = $info['password'];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }
    
}