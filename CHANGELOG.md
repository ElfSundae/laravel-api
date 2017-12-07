# Release Notes

## 1.7.0 (2017-12-08)

- Auto call `$app->configure('api')` for Lumen application

## 1.6.0 (2017-11-30)

- Optional `$request` for getting/setting current app key
- Remove `$app` parameter for `Helper::addAcceptableJsonTypeForRequest`

## 1.5.0 (2017-10-14)

- Don't defer service provider since it merges config file

## 1.3.2 (2017-09-27)

- Add `Helper::addAcceptableJsonTypeForRequest()`

## 1.3.1 (2017-09-15)

- Change methods name for ApiResponseException: `invalidInputException` to `invalidInput`, `actionFailureException` to `actionFailure`.

## 1.3.0 (2017-09-15)

- Add support for Laravel package auto-discovery
- Remove register facade alias
- Change: throw `ElfSundae\Laravel\Api\Exceptions\InvalidApiTokenException` in `VerifyApiToken` middleware
- Remove `ActionFailureException`, `InvalidInputException`. Use `ApiResponseException::invalidInputException()`, `ApiResponseException::actionFailureException()` instead.
- Add methods to generate api token as HTTP headers or URL query: `Token::generateHttpHeaders`, `Token::generateQueryData`, `Token::generateQueryString`

## 1.2.0 (2017-06-26)

- Change source struct
- Throw `ApiResponseException` when `VerifyApiToken` middleware failure

## 1.0.1 (2017-06-17)

- Added `ProfileJsonResponse` middleware

## 1.0.0 (2017-06-15)

- Initial release
