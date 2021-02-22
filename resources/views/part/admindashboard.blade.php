<div class="row">
    <div class="col-md-12">
        <h1>You are admin</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                List User
            </div>

            <div class="card-body">
                <div class="alert alert-success text-center">
                    <h3>Total Users: {{ $total_users }}</h3>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->created_at->diffInDays(\Carbon\Carbon::today()) > 30)
                                    {{ $user->created_at->format('m/d/Y') }}
                                @else
                                    <span class="badge badge-success">{{ $user->created_at->diffForHumans() }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Add User
            </div>

            <div class="card-body">
                @if(session('use_status'))
                    <div class="alert alert-success">
                        {{ session('use_status') }}
                    </div>
                @endif
                <form method="POST" action="{{ url('user/insert') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            <option value="">-Select One-</option>
                            <option value="2">Admin</option>
                            <option value="3">Shop Keeper</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>