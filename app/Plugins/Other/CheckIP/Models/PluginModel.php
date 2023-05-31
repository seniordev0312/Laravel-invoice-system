<?php
#App\Plugins\Other\CheckIP\Models\PluginModel.php
namespace App\Plugins\Other\CheckIP\Models;

use Illuminate\Database\Eloquent\Model;
use App\Plugins\Other\CheckIP\Models\CheckIPAccess;

class PluginModel extends Model
{
    public $timestamps    = false;
    public $table = '';
    protected $connection = SC_CONNECTION;
    protected $guarded    = [];

    public function uninstallExtension()
    {
        (new CheckIPAccess)->uninstall();
        return ['error' => 0, 'msg' => 'uninstall success'];
    }

    public function installExtension()
    {
        (new CheckIPAccess)->install();
        return ['error' => 0, 'msg' => 'install success'];
    }
    
}
