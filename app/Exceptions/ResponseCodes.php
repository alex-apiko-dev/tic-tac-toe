<?php

namespace App\Exceptions;

use Illuminate\Http\Response as HttpResponse;

interface ResponseCodes
{
    public const BAD_REQUEST_CODE = HttpResponse::HTTP_BAD_REQUEST;
    public const UNAUTHORIZED_CODE = HttpResponse::HTTP_UNAUTHORIZED;
    public const NOT_FOUND_CODE = HttpResponse::HTTP_NOT_FOUND;
    public const ACCEPTED_CODE = HttpResponse::HTTP_ACCEPTED;
    public const ACCESS_DENIED_CODE = HttpResponse::HTTP_FORBIDDEN;
    public const INTERNAL_ERROR_CODE = HttpResponse::HTTP_INTERNAL_SERVER_ERROR;
    public const NO_CONTENT_CODE = HttpResponse::HTTP_NO_CONTENT;
    public const OK_CODE = HttpResponse::HTTP_OK;
    public const CONFLICT_CODE = HttpResponse::HTTP_CONFLICT;
    public const NOT_ACCEPTABLE_CODE = HttpResponse::HTTP_NOT_ACCEPTABLE;
}
