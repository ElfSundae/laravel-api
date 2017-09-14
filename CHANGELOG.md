# Release Notes

## Unreleased

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
