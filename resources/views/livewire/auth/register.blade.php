<div>
    <dialog id="register_modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Register</h3>
            <form wire:submit.prevent="register">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" wire:model="name" class="input input-bordered" required />
                    @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" wire:model="email" class="input input-bordered" required />
                    @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" wire:model="username" class="input input-bordered" required />
                    @error('username') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" wire:model="password" class="input input-bordered" required />
                    @error('password') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" wire:model="password_confirmation" class="input input-bordered" required />
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="button" class="btn" onclick="register_modal.close()">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>
</div>
