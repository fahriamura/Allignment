<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;

class AdminDashboardPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.admin-dashboard-page';

    protected static ?string $navigationLabel = 'Admin Dashboard';
    protected static ?string $navigationGroup = 'Dashboard';

    public function render(): View
    {
        return view(static::$view, [
            'totalCourses' => \App\Models\Course::count(),
            'totalSubscriptions' => \App\Models\Subscription::count(),
            'totalUsers' => \App\Models\User::count(),
            'recentCourses' => \App\Models\Course::latest()->take(5)->get(),
        ]);
    }
}
