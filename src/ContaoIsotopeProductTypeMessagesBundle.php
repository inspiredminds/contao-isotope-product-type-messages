<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Product Type Messages extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoIsotopeProductTypeMessages;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoIsotopeProductTypeMessagesBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
