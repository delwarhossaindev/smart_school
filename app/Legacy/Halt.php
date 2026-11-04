<?php

namespace App\Legacy;

use Error;
use Symfony\Component\HttpFoundation\Response;

/**
 * Replaces exit/die in the migrated code so that Laravel still gets to save the
 * session and send the response. Extends Error so that legacy catch (Exception)
 * blocks cannot swallow it.
 */
class Halt extends Error
{
    public function __construct(public string $body = '', public ?Response $response = null)
    {
        parent::__construct('Legacy request halted');
    }
}
