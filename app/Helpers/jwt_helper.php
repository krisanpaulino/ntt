<?php

use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($otentikasiHeader)
{
    if (is_null($otentikasiHeader)) {
        throw new Exception("Otentikasi JWT Gagal!");
    }
    return explode(" ", $otentikasiHeader)[1];
}
function validateJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    $modelUser = new UserModel();
    return $modelUser->getLoginData($decodedToken->username);
}
function createJWT($username)
{
    $reqTime = time();
    $tokenTime = getenv('JWT_TIME_TO_LIVE');
    $expireTime = $reqTime + $tokenTime;
    $payload = [
        'username' => $username,
        'iat' => $reqTime,
        'exp' => $expireTime
    ];
    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
    return $jwt;
}

// $token = cekToken($token_skrang);

// function cekToken($token)  {
//     //DEcode ;
//     $decode = $token;
//     if(waktusekarang > $dekode->exp) {
//         post ulang 
//     }
// }
