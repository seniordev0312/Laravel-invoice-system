<?php
namespace App\Plugins\Other\CheckIP\Models;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Eloquent\Model;

class CheckIPAccess extends Model
{
    protected $guarded    = [];
    public $table = 'check_ip_access';
    protected $connection = SC_CONNECTION;

    
    public function uninstall()
    {
        if (Schema::hasTable($this->table)) {
            Schema::drop($this->table);
        }
    }

    public function install()
    {
        $this->uninstall();
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 20)->index();
            $table->string('description', 255)->nullable();
            $table->string('type', 10)->index();
            $table->timestamps();
        });
    }
    /**
     * Get list IP Allow
     */
    public static function getIpsAllow() {
        return self::where('type', 'allow')->pluck('ip')->all();
    }

    /**
     * Get list IP Deny
     */
    public static function getIpsDeny() {
        return self::where('type', 'deny')->pluck('ip')->all();
    }

}
