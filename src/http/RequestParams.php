<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\http;

use jayroncastro\jfphp\http\enums\DataType;

/**
 * An immutable DTO (Data Transfer Object) that encapsulates all the
 * information needed to define a parameter to be extracted from an
 * HTTP request, including its name, expected data type, and default value.
 * @package jayroncastro
 * @subpackage jfphp/http
 * @since 1.0.0
 * @version 1.0.0
 */
final readonly class RequestParams {

    /**
     * @param string $paramName
     * @param DataType $dataType
     * @param mixed|null $defaultValue
     */
    public function __construct(
        public string $paramName,
        public DataType $dataType = DataType::STRING,
        public mixed $defaultValue = null
    ) {}

}