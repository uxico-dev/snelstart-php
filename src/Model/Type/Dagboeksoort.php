<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @method static Dagboeksoort GEEN()
 * @method static Dagboeksoort KAS()
 * @method static Dagboeksoort BANK()
 * @method static Dagboeksoort GIRO()
 * @method static Dagboeksoort INKOOP()
 * @method static Dagboeksoort VERKOOP()
 * @method static Dagboeksoort MEMORIAAL()
 */
class Dagboeksoort extends Enum
{
    private const GEEN      = 'Geen';
    private const KAS       = 'Kas';
    private const BANK      = 'Bank';
    private const GIRO      = 'Giro';
    private const INKOOP    = 'Inkoop';
    private const VERKOOP   = 'Verkoop';
    private const MEMORIAAL = 'Memoriaal';
}
