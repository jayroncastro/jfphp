<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\http\enums;

/**
 * This `BackedEnum` defines the data types supported by the request system.
 * @package jayroncastro
 * @subpackage jfphp/http/enums
 * @since 1.0.0
 * @version 1.0.0
 */
enum DataType: string {
    case STRING = 'string';
    case INT = 'int';
    case FLOAT = 'float';
    case BOOL = 'bool';
    case EMAIL = 'email';
    case URL = 'url';
    case HTML = 'html';
    case TEXTAREA = 'textarea';
    case ARRAY = 'array';
    case RAW = 'raw'; // For unsanitized data
}