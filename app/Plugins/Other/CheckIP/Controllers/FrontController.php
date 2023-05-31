<?php
#App\Plugins\Other\CheckIp\Controllers\FrontController.php
namespace App\Plugins\Other\CheckIp\Controllers;

use App\Plugins\Other\CheckIp\AppConfig;
use SCart\Core\Front\Controllers\RootFrontController;
class FrontController extends RootFrontController
{
    public $plugin;

    public function __construct()
    {
        parent::__construct();
        $this->plugin = new AppConfig;
    }

    public function index() {
        return view($this->plugin->pathPlugin.'::Front',
            [
                //
            ]
        );
    }

    public function processOrder(){
        // Function require if plugin is payment method
    }
}
