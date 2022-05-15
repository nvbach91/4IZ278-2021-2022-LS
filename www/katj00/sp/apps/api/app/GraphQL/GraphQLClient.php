<?php

use Illuminate\Support\Facades\Http;

class GraphQLClient
{

//    private string $endpoint;
//
//    public function __construct(string $endpoint)
//    {
//        $this->endpoint = $endpoint;
//    }

    public static function query(string $endpoint, string $query, array $variables = [], ?string $token = null): \Illuminate\Http\Client\Response
    {
        $headers = ['Content-Type: application/json'];
        if (null !== $token) {
            $headers[] = "Authorization: Bearer $token";
        }
        try {
            return Http::acceptJson()->withHeaders($headers)->post($endpoint, json_encode(['query' => $query, 'variables' => $variables]));
        } catch (Exception $e) {
            throw new \ErrorException($e['message'], $e['type']);
        }
    }

}

