<?php

namespace App\Console\Commands;

use App\Model\Admin\Route;
use Illuminate\Console\Command;

class CreatRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creat:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成路由';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = base_path('routes').'/web.php';
        if(file_exists($path)){
            $content = $this->_writeContent();
            if(file_put_contents($path,$content)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    protected function _writeContent(){
        $content = '<?php '.PHP_EOL;
        $route = Route::whereIn('route_type',[
            'menu','operation','other','menu_son'
        ])->get()->toArray();
        $group = Route::select('route_namespace')->distinct()->get()->toArray();
        foreach ($group as $k => $v){
            $content .= "Route::group(['namespace'=>'".$v['route_namespace']."'],function () {".PHP_EOL;
            foreach ($route as $k2=>$v2){
                if($v2['route_namespace'] == $v['route_namespace']){
                    $content .= "    Route::".$v2['route_request_type'];
                    $content .= "(";
                    $content .= "'".$v2['route_url']."',";
                    if($v2['route_controller_namespace'] != '#'){
                        $content .= "'".$v2['route_controller_namespace']."\\".$v2['route_controller']."";
                    }else{
                        $content .= "'".$v2['route_controller']."";
                    }
                    $content .= "@".$v2['route_method']."'";
                    $content .= ")";
                    $content .= "->name(";
                    $content .= "'".$v2['route_as']."'";
                    $content .= ")";
                    if($v2['route_middleware'] != "[]"){
                        $content .= "->middleware(".$v2['route_middleware'].")";
                    }
                    $content .= ";".PHP_EOL;
                }
            }
            $content .= "});".PHP_EOL;
        }
        return $content;
    }
}
