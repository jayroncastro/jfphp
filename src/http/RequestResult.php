<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\http;

/**
 * Ensures that the type of data returned by a request handler is
 * always known and consistent, encapsulating the final value.
 * @package jayroncastro
 * @subpackage jfphp/http
 * @since 1.0.0
 * @version 1.0.0
 */
interface RequestResult {

    /**
     * Returns the sanitized and encapsulated value.
     * @return mixed
     */
    public function getValue(): mixed;
}