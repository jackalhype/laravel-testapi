<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @OA\Schema(
 *   schema="DocumentStatus",
 *   type="string",
 *   description="The status of a Document",
 *   enum={"DRAFT", "PUBLISHED"},
 *   default="DRAFT"
 * )
 */
final class DocumentStatus extends Enum
{
    const DRAFT     =   0;
    const PUBLISHED =   1;
}
