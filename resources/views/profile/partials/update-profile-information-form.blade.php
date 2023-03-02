<section>
    <header>
        <h2>
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1">
            {{ __("Update your account's profile information and email address.") }}
        </p>
        @if (session('status') === 'profile-updated')
            <script>
                const show = true;
                setTimeout(() => show = false, 2000)
                const el = document.getElementById('profile-status')
                if (show) {
                    el.style.display = 'block';
                }
            </script>
            <p id='profile-status' class="alert alert-success">{{ __('Saved.') }}</p>
        @endif
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="username">{{__('Username')}}</label>
            <input class="form-control mt-1" type="text" name="username" id="username" autocomplete="username" value="{{old('username', $user->username)}}" required autofocus>
            
            @error('username')
            <div class="alert alert-danger mt-2" role="alert">
                <strong>{{ $message}}</strong>
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name">{{__('Name')}}</label>
            <input class="form-control mt-1" type="text" name="name" id="name" autocomplete="name" value="{{old('name', $user->name)}}" required autofocus>
            @error('name')
            <div class="alert alert-danger mt-2" role="alert">
                <strong>{{ $message}}</strong>
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lastname">{{__('Lastname')}}</label>
            <input class="form-control mt-1" type="text" name="lastname" id="lastname" autocomplete="lastname" value="{{old('lastname', $user->lastname)}}" required autofocus>
            @error('lastname')
            <div class="alert alert-danger mt-2" role="alert">
                <strong>{{ $message}}</strong>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email">
                {{__('Email') }}
            </label>

            <input id="email" name="email" type="email" class="form-control mt-1" value="{{ old('email', $user->email)}}" required autocomplete="username" />

            @error('email')
            <div class="alert alert-danger mt-2" role="alert">
                <strong>{{ $message}}</strong>
            </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-muted">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="btn btn-outline-dark">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-success">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
    </form>
</section>
