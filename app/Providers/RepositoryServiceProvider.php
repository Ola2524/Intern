<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Books\BookRepositoryInterface;
use App\Repository\Books\BookRepository;
use App\Interfaces\Reports\ReportRepositoryInterface;
use App\Repository\Reports\ReportRepository;
use App\Interfaces\Borrowing\BorrowRepositoryInterface;
use App\Repository\Borrowing\BorrowRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(BorrowRepositoryInterface::class, BorrowRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
