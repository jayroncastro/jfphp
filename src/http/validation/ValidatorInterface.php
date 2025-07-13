<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\http\validation;

use jayroncastro\jfphp\exception\ValidationException;
use jayroncastro\jfphp\http\Request;

/**
 * This interface defines the contract for classes that validate
 * a request, if validation fails, the method must throw an exception.
 * @package jayroncastro
 * @subpackage jfphp/http/validation
 * @since 1.0.0
 * @version 2.0.0
 */
interface ValidatorInterface {

    /**
     * This method executes the validation logic.
     * @param Request $request The current request instance.
     * @return void
     * @throws ValidationException If validation fails.
     * @since 2.0.0
     */
    public function validate( Request $request ): void;
}