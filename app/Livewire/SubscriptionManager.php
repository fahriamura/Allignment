<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subscription;
use App\Models\User;
use Livewire\WithPagination;

class SubscriptionManager extends Component
{
    use WithPagination;

    public $user_id, $plan_name, $price, $started_at, $ended_at;
    public $editing_id;
    public $isEditing = false;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'plan_name' => 'required|string',
        'price' => 'required|numeric|min:0',
        'started_at' => 'required|date',
        'ended_at' => 'nullable|date|after:started_at',
    ];

    public function render()
    {
        return view('livewire.subscription-manager', [
            'subscriptions' => Subscription::with('user')->latest()->paginate(10),
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        $this->validate();

        Subscription::create([
            'user_id' => $this->user_id,
            'plan_name' => $this->plan_name,
            'price' => $this->price,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
        ]);

        $this->reset(['user_id', 'plan_name', 'price', 'started_at', 'ended_at']);
        session()->flash('message', 'Subscription created successfully.');
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        $this->editing_id = $id;
        $this->user_id = $subscription->user_id;
        $this->plan_name = $subscription->plan_name;
        $this->price = $subscription->price;
        $this->started_at = $subscription->started_at->format('Y-m-d\TH:i');
        $this->ended_at = $subscription->ended_at ? $subscription->ended_at->format('Y-m-d\TH:i') : null;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $subscription = Subscription::findOrFail($this->editing_id);
        $subscription->update([
            'user_id' => $this->user_id,
            'plan_name' => $this->plan_name,
            'price' => $this->price,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
        ]);

        $this->reset(['user_id', 'plan_name', 'price', 'started_at', 'ended_at', 'editing_id', 'isEditing']);
        session()->flash('message', 'Subscription updated successfully.');
    }

    public function delete($id)
    {
        Subscription::findOrFail($id)->delete();
        session()->flash('message', 'Subscription deleted successfully.');
    }

    public function cancel()
    {
        $this->reset(['user_id', 'plan_name', 'price', 'started_at', 'ended_at', 'editing_id', 'isEditing']);
    }
}