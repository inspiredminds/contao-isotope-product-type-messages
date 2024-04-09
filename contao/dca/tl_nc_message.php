<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Isotope Product Type Messages extension.
 *
 * (c) INSPIRED MINDS
 */

use Doctrine\DBAL\Platforms\MySQLPlatform;

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['iso_restrictToProductType'] = [
    'label' => ['Auf Produkt-Typ beschränken', 'Sendet diese Nachricht nur bei zutreffenden Bestellungen mit diesem Produkt-Typ im Warenkorb.'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr', 'submitOnChange' => true],
    'sql' => ['type' => 'boolean', 'default' => false],
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['iso_productTypeRestriction'] = [
    'label' => ['Erlaubte Produkt-Typen', 'Auswahl an gültigen Produkt-Typen, bei denen diese Nachricht verschickt wird.'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr', 'multiple' => true],
    'foreignKey' => 'tl_iso_producttype.name',
    'relation' => ['type' => 'hasMany', 'load' => 'lazy'],
    'sql' => ['type' => 'blob', 'length' => MySQLPlatform::LENGTH_LIMIT_BLOB, 'notnull' => false],
];

$GLOBALS['TL_DCA']['tl_nc_message']['palettes']['__selector__'][] = 'iso_restrictToProductType';
$GLOBALS['TL_DCA']['tl_nc_message']['subpalettes']['iso_restrictToProductType'] = 'iso_productTypeRestriction';
