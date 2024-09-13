<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    use WithPagination;

    public $name, $email, $password, $password_confirmation;
    public $editing_id;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function render()
    {
        return view('livewire.user-manager', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['name', 'email', 'password', 'password_confirmation']);
        session()->flash('message', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editing_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->editing_id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($this->editing_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'editing_id', 'isEditing']);
        session()->flash('message', 'User updated successfully.');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function cancel()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'editing_id', 'isEditing']);
    }
}