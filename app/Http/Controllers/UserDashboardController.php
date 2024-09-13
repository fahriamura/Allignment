<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\ZoomCourse;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Check if the user has an active subscription
        $hasActiveSubscription = $user->subscription && $user->subscription->isActive();

        if (!$hasActiveSubscription) {
            return redirect()->route('subscription.choose');
        }

        
        // Get courses based on subscription level
        $videoCourses = Course::where('subscription_level', '<=', $user->subscription->level)->get();
        $zoomCourses = ZoomCourse::where('subscription_level', '<=', $user->subscription->level)->get();

        return view('user.dashboard', compact('user', 'videoCourses', 'zoomCourses'));
    }
}