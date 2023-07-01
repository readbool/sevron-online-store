<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const USER_TABLE = 'users';

    private const ROLE_COLUMN = 'role';

    public function up(): void
    {
        if (Schema::hasColumn(self::USER_TABLE, self::ROLE_COLUMN) === true) {
            return;
        }

        Schema::table(self::USER_TABLE, static function (Blueprint $table) {
            $table->string('role')->nullable();
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn(self::USER_TABLE, self::ROLE_COLUMN) === false) {
            return;
        }

        Schema::table(self::USER_TABLE, static function (Blueprint $table) {
            $table->dropColumn(self::ROLE_COLUMN);
        });
    }
};
