<?php

namespace App\Providers;

use App\Modules\Approval\Application\ApprovalFacade;
use App\Modules\Approval\ApprovalFacadeInterface;
use App\Modules\Invoices\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Modules\Invoices\Repositories\EloquentInvoiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      $this->app->bind(
            ApprovalFacadeInterface::class,
            ApprovalFacade::class
        );
        $this->app->bind(
            InvoiceRepositoryInterface::class,
            EloquentInvoiceRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
