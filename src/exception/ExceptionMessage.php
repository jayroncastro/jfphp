<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\exception;

/**
 * This BackedEnum handles all exception messages
 * @package jayroncastro
 * @subpackage jfphp/exception
 * @since 1.0.0
 * @version 1.0.0
 * @final
 */
enum ExceptionMessage: string {
    case INDEX_OUT_OF_BOUNDS = 'The index provided is outside the allowed range, it must be: (index < 0 || index >= size())';
    case ILLEGAL_STATE = 'This operation cannot be performed at the current state of the iterator.';
    case NO_SUCH_ELEMENT = 'There is no such element to be returned by the iterator.';
    case VALIDATION_FAILED = 'The request did not pass the required validation checks.';
    case GENERIC_ERROR = 'A generic error occurred.';
    // Adicione outros casos conforme necessário
}

