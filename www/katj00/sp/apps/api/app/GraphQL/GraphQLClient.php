<?php

namespace App\GraphQL;

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
        try {
            return Http::acceptJson()->withToken($token)->post($endpoint, ['query' => $query, 'variables' => $variables]);
        } catch (Exception $e) {
            throw new \ErrorException($e['message'], $e['type']);
        }
    }

}

