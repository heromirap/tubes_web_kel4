<x-auth.layout :title="'Login'">
    <div class="container">
        <div class="form">
            <div class="col-lg-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Login</h1>
                    </div>

                    <form class="form-horizontal" method="post" action="/login">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="username" class="form-control" id="username" placeholder="Username"
                                        value="{{ old('username') }}" name="username">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="remember_me">Remember Me</label>
                                <input type="checkbox" id="remember_me" name="remember_me" @checked(old('remember_me'))>

                                @error('remember_me')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <p>Belum punya akun? <a href="/register">Daftar</a></p>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-auth.layout>