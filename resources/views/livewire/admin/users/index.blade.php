<div>
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Users Management</h2>
                <button wire:click="create" class="btn btn-primary">Add User</button>
            </div>
            <div class="mt-4">
                <input type="text" wire:model.live="search" placeholder="Search users..." 
                       class="input input-bordered w-full max-w-xs" />
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden">
                                        <img src="{{ $user->profile_img ?? 'https://ui-avatars.com/api/?name='.$user->name }}" 
                                             alt="{{ $user->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-medium">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <span class="badge {{ 
                                    match($user->role) {
                                        'admin' => 'badge-primary',
                                        'staff' => 'badge-secondary',
                                        'user' => 'badge-ghost',
                                        default => 'badge-ghost'
                                    }
                                }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <label class="cursor-pointer">
                                    <input type="checkbox" 
                                           class="toggle toggle-success"
                                           wire:click="toggleActive({{ $user->id }})"
                                           @checked($user->is_active) />
                                </label>
                            </td>
                            <td>
                                <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-ghost">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <dialog class="modal" {{ $showModal ? 'open' : '' }}>
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">{{ $userId ? 'Edit User' : 'Add New User' }}</h3>
            <form wire:submit.prevent="save">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" wire:model="name" class="input input-bordered" required />
                    @error('name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" wire:model="email" class="input input-bordered" required />
                    @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" wire:model="username" class="input input-bordered" required />
                    @error('username') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Password {{ $userId ? '(Leave blank to keep current)' : '' }}</span>
                    </label>
                    <input type="password" wire:model="password" class="input input-bordered" {{ $userId ? '' : 'required' }} />
                    @error('password') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select wire:model="role" class="select select-bordered" required>
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label cursor-pointer">
                        <span class="label-text">Active</span>
                        <input type="checkbox" wire:model="is_active" class="toggle" />
                    </label>
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn" wire:click="$toggle('showModal')">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>
</div> 