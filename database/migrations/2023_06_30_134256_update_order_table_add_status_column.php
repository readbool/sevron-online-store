<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'orders';

    private const STATUS_COLUMN = 'status';

    public function up(): void
    {
        if (Schema::hasColumn(self::TABLE, self::STATUS_COLUMN) === true) {
            return;
        }

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->string(self::STATUS_COLUMN)->nullable();
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn(self::TABLE, self::STATUS_COLUMN) === true) {
            return;
        }

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->string(self::STATUS_COLUMN)->nullable();
        });
    }
};
