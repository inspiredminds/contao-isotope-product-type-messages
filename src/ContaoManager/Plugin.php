<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Product Type Messages extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoIsotopeProductTypeMessages\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use InspiredMinds\ContaoIsotopeProductTypeMessages\ContaoIsotopeProductTypeMessagesBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoIsotopeProductTypeMessagesBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, 'notification_center']),
        ];
    }
}
