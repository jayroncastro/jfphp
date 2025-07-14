<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\http;

use jayroncastro\jfphp\http\enums\DataType;
use jayroncastro\jfphp\http\validation\ValidatorInterface;

/**
 * This class orchestrates the receipt of data from HTTP requests,
 * providing a unified API for securely accessing parameters,
 * regardless of method (`GET`, `POST`, `PUT`) or format (`JSON`,
 * `form-data`).
 * @package jayroncastro
 * @subpackage jfphp/http
 * @since 1.0.0
 * @version 2.0.0
 */
final class Request {

    /**
     * The sanitizer object that will be used to sanitize the data.
     * @var SanitizerInterface
     */
    private SanitizerInterface $sanitizer;

    /**
     * An array containing all the parsed data from the request.
     * @var array
     */
    private readonly array $data;

    /**
     * The HTTP method detected for this request.
     * @var HttpMethod
     */
    public readonly HttpMethod $method;

    /**
     * This method is the constructor of the class
     * @param SanitizerInterface $sanitizer A concrete implementation of the sanitizer.
     */
    public function __construct( SanitizerInterface $sanitizer ) {
        $this->sanitizer = $sanitizer;
        $this->method = HttpMethod::tryFrom( $_SERVER[ 'REQUEST_METHOD' ] ?? 'GET' ) ?? HttpMethod::GET;
        $this->data = $this->parseRequestData();
    }

    /**
     * Returns a specific request parameter, already sanitized and encapsulated.
     * @param RequestParams $params Object describing the desired parameter.
     * @return RequestResult Returns a result object with a type (e.g. `StringResult`).
     */
    public function getParam( RequestParams $params ): RequestResult {
        $rawValue = $this->data[ $params->paramName ] ?? $params->defaultValue;
        return $this->sanitizer->sanitize( $rawValue, $params->dataType );
    }

    /**
     * Returns all parsed data from the request.
     * @return array
     */
    public function all(): array {
        return $this->data;
    }

    /**
     * This method routes the reading of the request data based on the HTTP method.
     * @return array
     */
    private function parseRequestData(): array {
        return match ( $this->method ) {
            HttpMethod::GET => $_GET,
            HttpMethod::POST => $_POST,
            HttpMethod::PUT, HttpMethod::PATCH,
            HttpMethod::DELETE => $this->parseBody(),
            default => [],
        };
    }

    /**
     * This method parses the request body, trying JSON first,
     * then `form-urlencoded`.
     * @return array
     */
    private function parseBody(): array {
        $body = file_get_contents( 'php://input' );

        if ( empty( $body ) ) {
            return [];
        }

        $jsonData = json_decode( $body, true );
        if ( json_last_error() === JSON_ERROR_NONE ) {
            return $jsonData;
        }

        parse_str( $body, $parsedData );
        return $parsedData;
    }

    /**
     * Checks if a parameter exists in the request.
     * @param string $paramName The name of the parameter to be checked.
     * @return bool Returns `true` if the parameter exists, even if its value is null.
     * @since 1.1.0
     * @version 1.1.0
     */
    public function has( string $paramName ): bool {
        return array_key_exists( $paramName, $this->data );
    }

    /**
     * This method runs a series of validators on the request and throws
     * an exception if any of the validators fail.
     * @param ValidatorInterface[] $validators This parameter receives an
     * array of validator objects.
     * @return $this Returns the Request instance itself for chaining.
     * @since 2.0.0
     * @version 2.0.0
     */
    public function validate( array $validators ): self {
        foreach ( $validators as $validator ) {
            if ( $validator instanceof ValidatorInterface ) {
                $validator->validate( $this );
            }
        }
        return $this;
    }

    /**
     * This method is a shortcut to fetch, sanitize and return the
     * value of a single parameter; it serves to simplify the call to
     * getParam, hiding the need to instantiate a RequestParams for
     * simple use cases.
     * @param string $paramName The name of the parameter in the request.
     * @param DataType $dataType The expected data type.
     * @param mixed|null $defaultValue
     * @return mixed The final, sanitized value.
     * @since 2.0.0
     */
    public function input(string $paramName,
                          DataType $dataType = DataType::STRING,
                          mixed $defaultValue = null): mixed {

        $params = new RequestParams(
            paramName: $paramName,
            dataType: $dataType,
            defaultValue: $defaultValue
        );
        return $this->getParam( $params )->getValue();
    }
}