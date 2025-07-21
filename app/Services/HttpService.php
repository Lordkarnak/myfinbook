<?php

namespace App\Services;

class HttpService
{
    public const HTTP_RESPONSE_OK = 200;
    public const HTTP_RESPONSE_CREATED = 201;
    public const HTTP_RESPONSE_ACCEPTED = 202;
    public const HTTP_RESPONSE_MOVED_PERMANENTLY = 301;
    public const HTTP_RESPONSE_FOUND = 302;
    public const HTTP_RESPONSE_PERMANENT_REDIRECT = 308;
    public const HTTP_RESPONSE_BAD_REQUEST = 400;
    public const HTTP_RESPONSE_UNAUTHORIZED = 401;
    public const HTTP_RESPONSE_FORBIDDEN = 403;
    public const HTTP_RESPONSE_NOT_FOUND = 404;
    public const HTTP_RESPONSE_SERVER_ERROR = 500;

    public const JSON_RESPONSE_STATUS_SUCCESS = 'SUCCESS';
    public const JSON_RESPONSE_STATUS_FAILED = 'FAILED';
    public const JSON_RESPONSE_STATUS_ERROR = 'ERROR';

    public const HTTP_METHOD_GET = 'GET';
    public const HTTP_METHOD_HEAD = 'HEAD';
    public const HTTP_METHOD_POST = 'POST';
    public const HTTP_METHOD_PUT = 'PUT';
    public const HTTP_METHOD_PATCH = 'PATCH';
    public const HTTP_METHOD_DELETE = 'DELETE';

    public const HTTP_FAILED_REQUESTS = [
        self::HTTP_RESPONSE_BAD_REQUEST     => 1,
        self::HTTP_RESPONSE_UNAUTHORIZED    => 1,
        self::HTTP_RESPONSE_FORBIDDEN       => 1,
        self::HTTP_RESPONSE_NOT_FOUND       => 1,
        self::HTTP_RESPONSE_SERVER_ERROR    => 1,
    ];

    public static function isFailedRequest(int $responseCode): bool
    {
        return isset(self::HTTP_FAILED_REQUESTS[$responseCode]);
    }
}
