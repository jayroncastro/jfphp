<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\http\result;

use jayroncastro\jfphp\http\RequestResult;
use jayroncastro\jfphp\lang\ValueObject;

/**
 * Implementation of `RequestResult` that immutably encapsulates a
 * value that has been sanitized and validated as a `bool`.
 * @extends ValueObject
 * @implements RequestResult
 * @package jayroncastro
 * @subpackage jfphp/http/result
 * @since 1.0
 * @version 1.0
 * @final
 * @readonly
 */
final readonly class BoolResult extends ValueObject implements RequestResult {

    /**
     * This method is the constructor of the class.
     * @param bool $value
     */
    public function __construct( bool $value ) {
        parent::__construct( $value );
    }

    /**
     * This method returns the value of the object
     * @return bool
     */
    public function getValue(): bool {
        return $this->value;
    }
}