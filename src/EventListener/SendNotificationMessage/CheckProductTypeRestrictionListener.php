<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Product Type Messages extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoIsotopeProductTypeMessages\EventListener\SendNotificationMessage;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\StringUtil;
use Isotope\Model\ProductCollection\Order;
use NotificationCenter\Model\Message;
use NotificationCenter\Model\Notification;

/**
 * Applies the Isotope product type restriction to the message.
 *
 * @Hook("sendNotificationMessage", priority=100)
 */
class CheckProductTypeRestrictionListener
{
    public function __invoke(Message $message, array $tokens): bool
    {
        // Check if this is the correct notification type first.
        if (!($notification = Notification::findById($message->pid)) || 'iso_order_status_change' !== $notification->type) {
            return true;
        }

        // No restrictions applied.
        if (!$message->iso_restrictToProductType) {
            return true;
        }

        // Do not send if there are no restrictions selected.
        if (!$restrictions = array_filter(StringUtil::deserialize($message->iso_productTypeRestriction, true))) {
            return false;
        }

        // Do not send if there is no actual order in the tokens.
        if (!($tokens['order_id'] ?? null) || !($order = Order::findById($tokens['order_id']))) {
            return false;
        }

        $productTypeIds = [];

        /** @var Order $order */
        foreach ($order->getItems() as $item) {
            if (!$product = $item->getProduct()) {
                continue;
            }

            if (!$type = $product->getType()) {
                continue;
            }

            $productTypeIds[] = (int) $type->id;
        }

        return (bool) array_intersect(array_map('intval', $restrictions), $productTypeIds);
    }
}
