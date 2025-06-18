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
 * This interface defines the contract for classes that act as data `sanitizers`.
 * A class that implements this interface is responsible for receiving a
 * raw value and a data type and returning a RequestResult object with
 * the value cleaned, validated and properly encapsulated.
 * @package jayroncastro
 * @subpackage jfphp/http
 * @since 1.0.0
 * @version 1.0.0
 */
interface SanitizerInterface {

    /**
     * This method sanitizes a value according to a specified data type
     * and encapsulates it in an appropriate result object.
     * @param mixed $value The gross amount coming from the request.
     * @param DataType $dataType The target data type (e.g. `email`, `int`, `string`).
     * @return RequestResult Returns an object that implements `RequestResult` (e.g. `StringResult`, `IntResult`).
     */
    public function sanitize( mixed $value, DataType $dataType ): RequestResult;
}