<?php
/**
 * Plugin format 2.0
 */
#App\Plugins\Other\CheckIP\AppConfig.php
namespace App\Plugins\Other\CheckIP;

use App\Plugins\Other\CheckIP\Models\PluginModel;
use SCart\Core\Admin\Models\AdminConfig;
use App\Plugins\ConfigDefault;
use SCart\Core\Admin\Models\AdminMenu;
use SCart\Core\Front\Models\Languages;

class AppConfig extends ConfigDefault
{
    public function __construct()
    {
        //Read config from config.json
        $config = file_get_contents(__DIR__.'/config.json');
        $config = json_decode($config, true);
    	$this->configGroup = $config['configGroup'];
    	$this->configCode = $config['configCode'];
        $this->configKey = $config['configKey'];
        $this->scartVersion = $config['scartVersion'];
        //Path
        $this->pathPlugin = $this->configGroup . '/' . $this->configCode . '/' . $this->configKey;
        //Language
        $this->title = trans($this->pathPlugin.'::lang.title');
        //Image logo or thumb
        $this->image = $this->pathPlugin.'/'.$config['image'];
        //
        $this->version = $config['version'];
        $this->auth = $config['auth'];
        $this->link = $config['link'];
    }

    public function install()
    {
        $return = ['error' => 0, 'msg' => ''];
        $check = AdminConfig::where('key', $this->configKey)->first();
        if ($check) {
            //Check Plugin key exist
            $return = ['error' => 1, 'msg' =>  sc_language_render('admin.plugin.plugin_exist')];
        } else {

            $checkMenu = AdminMenu::where('key', $this->configKey)->first();
            if (!$checkMenu) {
                $menuSecurity = AdminMenu::where('key', 'ADMIN_SECURITY')->first();
                if (!$menuSecurity) {
                    $idSecurity = AdminMenu::insertGetId([
                        'parent_id' => 9,
                        'sort' => 6,
                        'title' => 'admin.menu_titles.security',
                        'icon' => 'fab fa-shirtsinbulk',
                        'key' => 'ADMIN_SECURITY',
                    ]);
                } else {
                    $idSecurity = $menuSecurity->id;
                }

                AdminMenu::insertGetId([
                    'parent_id' => $idSecurity,
                    'title' => $this->pathPlugin.'::lang.title',
                    'icon' => 'fa fa-braille',
                    'uri' => 'route::admin_checkip.index',
                    'key' => $this->configKey,
                ]);
            }

            //Insert plugin to config
            $dataInsert = [
                [
                    'group'  => $this->configGroup,
                    'code'   => $this->configCode,
                    'key'    => $this->configKey,
                    'sort'   => 0,
                    'value'  => self::ON, //Enable extension
                    'detail' => $this->pathPlugin.'::lang.title',
                ],
            ];
            $process = AdminConfig::insert(
                $dataInsert
            );

            if (!$process) {
                $return = ['error' => 1, 'msg' => sc_language_render('admin.plugin.install_faild')];
            } else {
                $return = (new PluginModel)->installExtension();
            }
        }

        $dataLang = [
            ['code' => 'admin.checkip.add_new_title', 'text' => 'Add new IP', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.add_new_title', 'text' => 'Thêm mới địa chỉ IP', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.list', 'text' => 'Management IP', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.list', 'text' => 'Quản lý địa chỉ IP', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.ip', 'text' => 'IP', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.ip', 'text' => 'IP', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.description', 'text' => 'Description', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.description', 'text' => 'Mô tả', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.allow', 'text' => 'Allow', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.allow', 'text' => 'Cho phép', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.deny', 'text' => 'Deny', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.deny', 'text' => 'Ngăn chặn', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.action', 'text' => 'Action', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.action', 'text' => 'Hành động', 'position' => 'checkip', 'location' => 'vi'],
            ['code' => 'admin.checkip.ip_help', 'text' => 'Ex: 1.2.3.4<br>Use "<span style="color:red">*</span>" for all IPs.<br>', 'position' => 'checkip', 'location' => 'en'],
            ['code' => 'admin.checkip.ip_help', 'text' => 'VD: 1.2.3.4<br>Sử dụng "<span style="color:red">*</span>" cho mọi IP.<br>', 'position' => 'checkip', 'location' => 'vi'],
            
        ];
        Languages::insertOrIgnore(
            $dataLang
        );



        return $return;
    }

    public function uninstall()
    {
        $return = ['error' => 0, 'msg' => ''];
        //Please delete all values inserted in the installation step
        $process = (new AdminConfig)
            ->where('key', $this->configKey)
            ->orWhere('code', $this->configKey.'_config')
            ->delete();
        if (!$process) {
            $return = ['error' => 1, 'msg' => sc_language_render('admin.plugin.action_error', ['action' => 'Uninstall'])];
        }
        (new AdminMenu)->where('key', $this->configKey)->delete();

        (new PluginModel)->uninstallExtension();
        return $return;
    }
    
    public function enable()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)->where('key', $this->configKey)->update(['value' => self::ON]);
        if (!$process) {
            $return = ['error' => 1, 'msg' => 'Error enable'];
        }
        return $return;
    }

    public function disable()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)
            ->where('key', $this->configKey)
            ->update(['value' => self::OFF]);
        if (!$process) {
            $return = ['error' => 1, 'msg' => 'Error disable'];
        }
        return $return;
    }

    public function config()
    {
        //redirect to url config of plugin
        return redirect(sc_route_admin('admin_checkip.index'));
    }

    public function getData()
    {
        $arrData = [
            'title' => $this->title,
            'code' => $this->configCode,
            'key' => $this->configKey,
            'image' => $this->image,
            'permission' => self::ALLOW,
            'version' => $this->version,
            'auth' => $this->auth,
            'link' => $this->link,
            'value' => 0, // this return need for plugin shipping
            'pathPlugin' => $this->pathPlugin
        ];

        return $arrData;
    }

    /**
     * Process after order success
     *
     * @param   [array]  $data  
     *
     */
    public function endApp($data = []) {
        //action after end app
    }
}
