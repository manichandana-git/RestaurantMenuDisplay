<?php
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase {
    private $url = "http://localhost:8000/register.php";

    public function testRegisterUser() {
        $data = [
            "name" => "Test User",
            "email" => "test@example.com",
            "password" => "Test1234"
        ];

        $response = $this->makePostRequest($this->url, $data);
        $this->assertEquals("Registration successful", $response["message"]);
    }

    private function makePostRequest($url, $data) {
        $options = [
            "http" => [
                "header"  => "Content-Type: application/json",
                "method"  => "POST",
                "content" => json_encode($data)
            ]
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result, true);
    }
}
