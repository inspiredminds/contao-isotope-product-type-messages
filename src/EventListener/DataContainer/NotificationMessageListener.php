<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Product Type Messages extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoIsotopeProductTypeMessages\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use NotificationCenter\Model\Message;
use NotificationCenter\Model\Notification;

class NotificationMessageListener
{
    /**
     * Adds the Isotope related fields to the message, in case the notification is of type 'iso_order_status_change'.
     *
     * @Callback(table="tl_nc_message", target="config.onload")
     */
    public function onLoad(DataContainer $dc): void
    {
        if (!$message = Message::findById($dc->id)) {
            return;
        }

        if (!$notification = Notification::findById($message->pid)) {
            return;
        }

        if ('iso_order_status_change' !== $notification->type) {
            return;
        }

        PaletteManipulator::create()
            ->addLegend('isotope_legend', null, PaletteManipulator::POSITION_AFTER, true)
            ->addField('iso_restrictToProductType', 'isotope_legend', PaletteManipulator::POSITION_APPEND)
            ->applyToPalette('email', 'tl_nc_message')
        ;
    }
}
