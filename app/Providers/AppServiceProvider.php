<?php

namespace App\Providers;

use App\Http\Controllers\GeneralController;
use App\Models\Admin\AparienciaIntranet;
use App\Models\Admin\Empresa;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Menu;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    //use GeneralController;

    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            $space_private = GeneralController::space_disk('private');
            View::share('space_private', $space_private);

            $space_max = '5';
            View::share('space_max', $space_max);

            $empresa = Empresa::findOrFail(1)->toArray();
            session(['empresa' => $empresa]);

            View::share('empresa', $empresa);

            $theme='lte3';

            View::composer("theme.$theme.aside", function ($view) {
                if (session()->get('rol_id')==1) {
                    $menus = Menu::getMenu(false);
                } else {
                    $menus = Menu::getMenu(true);
                }
                $view->with('menusComposer', $menus);
            });

            if($apariencia = AparienciaIntranet::find(1)){
                View::share('aside',$apariencia->aside);
                View::share('brand',$apariencia->brand);
                View::share('navbar',$apariencia->navbar);
                View::share('card_color',$apariencia->card_color);

            }else{
                View::share('aside', 'sidebar-dark-primary');
                View::share('brand', 'navbar-light');
                View::share('navbar', 'navbar-dark');
                View::share('card_color', 'card-primary');
            }

            View::share('theme', $theme);
            View::share('footer', '');

            /*
            var navbar_dark_skins = [
                'navbar-primary',
                'navbar-secondary',
                'navbar-info',
                'navbar-success',
                'navbar-danger',
                'navbar-indigo',
                'navbar-purple',
                'navbar-pink',
                'navbar-teal',
                'navbar-cyan',
                'navbar-dark',
                'navbar-gray-dark',
                'navbar-gray',
            ]

            var navbar_light_skins = [
                'navbar-light',
                'navbar-warning',
                'navbar-white',
                'navbar-orange',
            ]

            var sidebar_skins = [
                'sidebar-dark-primary',
                'sidebar-dark-warning',
                'sidebar-dark-info',
                'sidebar-dark-danger',
                'sidebar-dark-success',
                'sidebar-dark-indigo',
                'sidebar-dark-navy',
                'sidebar-dark-purple',
                'sidebar-dark-fuchsia',
                'sidebar-dark-pink',
                'sidebar-dark-maroon',
                'sidebar-dark-orange',
                'sidebar-dark-lime',
                'sidebar-dark-teal',
                'sidebar-dark-olive',
                'sidebar-light-primary',
                'sidebar-light-warning',
                'sidebar-light-info',
                'sidebar-light-danger',
                'sidebar-light-success',
                'sidebar-light-indigo',
                'sidebar-light-navy',
                'sidebar-light-purple',
                'sidebar-light-fuchsia',
                'sidebar-light-pink',
                'sidebar-light-maroon',
                'sidebar-light-orange',
                'sidebar-light-lime',
                'sidebar-light-teal',
                'sidebar-light-olive'
            ]

            var sidebar_colors = [
                'bg-primary',
                'bg-warning',
                'bg-info',
                'bg-danger',
                'bg-success',
                'bg-indigo',
                'bg-navy',
                'bg-purple',
                'bg-fuchsia',
                'bg-pink',
                'bg-maroon',
                'bg-orange',
                'bg-lime',
                'bg-teal',
                'bg-olive'
            ]
            */
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
}
