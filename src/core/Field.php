<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\core;

use jayroncastro\jfphp\http\Request;
use jayroncastro\jfphp\http\RequestParams;
use jayroncastro\jfphp\persistence\PersistenceInterface;

/**
 * This class manages the entire lifecycle of a field: it gets the
 * new value from the request, gets the old value from persistence,
 * compares, and saves it.
 * @package jayroncastro
 * @subpackage jfphp/core
 * @readonly
 * @final
 * @since 1.2.0
 * @version 1.2.0
 */
final readonly class Field {

    public mixed $oldValue;
    public mixed $newValue;

    public function __construct(
        private int $objectId,
        private Request $request,
        private PersistenceInterface $persistence,
        private RequestParams $params
    ) {
        $this->oldValue = $this->persistence->get(
            $this->objectId,
            $this->params->paramName
        );
        $this->newValue = $this->request->getParam( $this->params )->getValue();
    }

    public function hasChanged(): bool {
        # Convert to string for safer comparison between different types
        # (e.g. '123' vs. 123)
        return ( string ) $this->oldValue !== ( string ) $this->newValue;
    }

    public function save(): bool {
        return $this->persistence->save(
            $this->objectId,
            $this->params->paramName,
            $this->newValue
        );
    }
}