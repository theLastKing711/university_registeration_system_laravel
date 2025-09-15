<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateResourseInvokableControllersWithData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resourse-data-controller {path} {--with-pagination}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Laravel-Spatie-Data File';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $path =
            $this->argument('path');

        [$role, $resourse] =
            explode('\\', $path);

        $this
            ->genereateBaseAbstractClass($path, $resourse);

        if ($this->option('with-pagination')) {
            $this
                ->generateGetManyWithPaginationController($path, $resourse);
        } else {
            $this
                ->generateGetManyController($path, $resourse);
        }

        $this
            ->generateGetController($path, $resourse);

        $this->
            generatePostController($path, $resourse);

        $this
            ->generatePatchController($path, $resourse);

        $this
            ->generateDeleteController($path, $resourse);

    }

    private function genereateBaseAbstractClass($path, $resourse)
    {
        $abstract_name =
            'Abstract'
                .$path
                .'\\'
                ."{$resourse}";

        Artisan::call('make:controller', [
            'name' => $abstract_name,
            '--abstract',
        ]);
    }

    private function generateGetManyController($path, $resourse)
    {
        $resourse_plural =
            $resourse
                .'s';

        $get_name =
            $path
                .'\\'
                ."Get{$resourse_plural}";

        $get_response_data =
            $get_name
                .'\\'
                .'Response'
                .'\\'
                ."Get{$resourse_plural}Response";

        Artisan::call('make:data-controller', [
            'name' => $get_name,
            '--get-many' => $get_response_data,
        ]);
    }

    private function generateGetManyWithPaginationController($path, $resourse)
    {

        $resourse_plural =
            $resourse
                .'s';

        $get_name =
           $path
               .'\\'
               ."Get{$resourse_plural}";

        $get_response_data =
            $get_name
                .'\\'
                .'Response'
                .'\\'
                ."Get{$resourse_plural}Response";

        $pagination_name =
            $path
                .'\\'
                ."Get{$resourse_plural}";

        $pagination_request_data =
            $pagination_name
                .'\\'
                .'Request'
                .'\\'
                ."Get{$resourse_plural}Request";

        Artisan::call('make:data-controller', [
            'name' => $get_name,
            '--get-many' => $get_response_data,
            '--pagination' => $pagination_request_data,
        ]);
    }

    private function generateGetController($path, $resourse)
    {
        $get_name =
            $path
                .'\\'
                ."Get{$resourse}";

        $get_request_data =
            $get_name
                .'\\'
                .'Request'
                .'\\'
                ."Get{$resourse}Request";

        Artisan::call('make:data-controller', [
            'name' => $get_name,
            '--get-one' => $get_request_data,
        ]);
    }

    private function generatePostController($path, $resourse)
    {
        $post_name =
            $path
                .'\\'
                ."Create{$resourse}";

        $post_request_data =
            $post_name
                .'\\'
                .'Request'
                .'\\'
                ."Create{$resourse}Request";

        Artisan::call('make:data-controller', [
            'name' => $post_name,
            '--post' => $post_request_data,
        ]);
    }

    private function generatePatchController($path, $resourse)
    {
        $patch_name =
            $path
                .'\\'
                ."Update{$resourse}";

        $patch_request_data =
            $patch_name
                .'\\'
                .'Request'
                .'\\'
                ."Update{$resourse}Request";

        Artisan::call('make:data-controller', [
            'name' => $patch_name,
            '--patch' => $patch_request_data,
        ]);
    }

    private function generateDeleteController($path, $resourse)
    {
        $delete_name =
            $path
                .'\\'
                ."Delete{$resourse}";

        $delete_request_data =
            $delete_name
                .'\\'
                .'Request'
                .'\\'
                ."Delete{$resourse}Request";

        Artisan::call('make:data-controller', [
            'name' => $delete_name,
            '--delete-one' => $delete_request_data,
        ]);
    }
}
