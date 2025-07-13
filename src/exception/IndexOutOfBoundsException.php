<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\exception;

use Exception;

/**
 * This class handles index type-out-of-range exceptions.
 * @package jayroncastro
 * @subpackage jfphp/exception
 * @extends Exception
 * @since 1.0.0
 * @version 1.0.0
 */
final class IndexOutOfBoundsException extends Exception {

    /**
     * This method is the constructor of the class.
     * @param string $message This parameter receives an exception message.
     * @param int $code This parameter receives an exception code.
     */
    public function __construct( string $message = '', int $code = 0 ) {
        parent::__construct(
            $message ?: ExceptionMessage::INDEX_OUT_OF_BOUNDS->value,
            $code
        );
    }
}