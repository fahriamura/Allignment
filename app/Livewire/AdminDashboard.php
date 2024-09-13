<?php

namespace App\Livewire;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\User;
use App\Models\ZoomCourse;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class AdminDashboard extends Component
{
    #[Reactive]
    public $currentSection = 'dashboard';
    public $sectionTitle = 'Dashboard';
    public $showCategoryDialog = false;
    public $showVideoDialog = false;
    public $showZoomCourseDialog = false;
    public $showSubscriptionDialog = false;
    public $showUserDialog = false;

    // Form data
    public $categoryName = '';
    public $categoryType = '';
    public $videoTitle = '';
    public $videoUrl = '';
    public $zoomTopic = '';
    public $zoomDate = '';
    public $zoomTime = '';
    public $subscriptionName = '';
    public $subscriptionPrice = '';
    public $subscriptionDuration = '';
    public $userName = '';
    public $userEmail = '';
    public $userSubscription = '';

    public function showSection($section)
    {
        $this->currentSection = $section;
        $this->sectionTitle = ucfirst($section);
    }

    public function openDialog($dialog)
    {
        $this->{"show{$dialog}Dialog"} = true;
    }

    public function closeDialog($dialog)
    {
        $this->{"show{$dialog}Dialog"} = false;
    }

    public function addCategory()
    {
        // Validate and save category
        $this->validate([
            'categoryName' => 'required|min:3',
            'categoryType' => 'required|in:silver,gold,platinum',
        ]);

        // Save category logic here

        $this->closeDialog('Category');
        $this->reset(['categoryName', 'categoryType']);
    }

    public function addVideo()
    {
        // Validate and save video
        $this->validate([
            'videoTitle' => 'required|min:3',
            'videoUrl' => 'required|url',
        ]);

        // Save video logic here

        $this->closeDialog('Video');
        $this->reset(['videoTitle', 'videoUrl']);
    }

    public function addZoomCourse()
    {
        // Validate and save Zoom course
        $this->validate([
            'zoomTopic' => 'required|min:3',
            'zoomDate' => 'required|date',
            'zoomTime' => 'required',
        ]);

        // Save Zoom course logic here

        $this->closeDialog('ZoomCourse');
        $this->reset(['zoomTopic', 'zoomDate', 'zoomTime']);
    }

    public function addSubscription()
    {
        // Validate and save subscription
        $this->validate([
            'subscriptionName' => 'required|min:3',
            'subscriptionPrice' => 'required|numeric|min:0',
            'subscriptionDuration' => 'required|in:monthly,yearly',
        ]);

        // Save subscription logic here

        $this->closeDialog('Subscription');
        $this->reset(['subscriptionName', 'subscriptionPrice', 'subscriptionDuration']);
    }

    public function addUser()
    {
        // Validate and save user
        $this->validate([
            'userName' => 'required|min:3',
            'userEmail' => 'required|email',
            'userSubscription' => 'required|in:silver,gold,platinum',
        ]);

        // Save user logic here

        $this->closeDialog('User');
        $this->reset(['userName', 'userEmail', 'userSubscription']);
    }
    public function render()
    {
        try {
            return view('livewire.admin-dashboard');
        } catch (\Exception $e) {
            logger()->error('Error in AdminDashboard component: ' . $e->getMessage());
            return view('livewire.error', ['message' => 'An error occurred. Please try again.']);
        }
    }
}
