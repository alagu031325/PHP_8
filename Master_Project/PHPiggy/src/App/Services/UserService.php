<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use Framework\Validator;
use PO;

class UserService
{
    public function __construct(private Database $db)
    {
    }

    //validation of form inputs - ValidatorService 
    //validating against the DB - UserService
    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0)
        {
            //Email already exists so we need to throw error
            throw new ValidationException(['email' => 'Email Taken']);
        }
    }

    public function create(array $formData)
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, [
            'cost' => 12
        ]);

        $this->db->query(
            "INSERT INTO users(email,password,age,country,social_media_url) VALUES(:email, :password, :age, :country, :url)",
            [
                'email' => $formData['email'],
                'password' => $password,
                'age' => $formData['age'],
                'country' => $formData['country'],
                'url' => $formData['socialMediaURL'],
            ]
        );

        session_regenerate_id();
        $_SESSION['user'] = $this->db->id();
    }

    public function login(array $formData)
    {
        $user = $this->db->query(
            "SELECT * FROM users WHERE email = :email",
            [
                'email' => $formData['email']
            ]
        )->find();

        $passwordMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordMatch)
        {
            throw new ValidationException(['password' => ['Invalid credentials']]);
        }

        //store the user details in session - only id dont change - other values can change in the DB
        session_regenerate_id();
        //regenerate the id after user logs in
        $_SESSION['user'] = $user['id'];
    }

    public function logout()
    {
        //removes users authentication status
        //unset($_SESSION['user']);

        //entirely delete the session data
        session_destroy();

        //session_regenerate_id();

        //creates or updates the existing cookie - update expiry date/time(random time in past) - to delete the browser cookie
        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSIONID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly'],
        );
    }
}
