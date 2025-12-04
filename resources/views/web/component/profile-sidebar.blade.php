<!-- resources\views\web\component\profile-sidebar.blade.php -->
<nav class="dashboard-nav my-10 mb-md-0">
    <div class="top-main-bf">
        <div class="userinfo">
            <div class="img-edt">
                <i class="fa fa-user usericon"></i>
            </div>
            <h4>{{ Auth::user()->name }}</h4>
        </div>
    </div>
    <ul>
        <li class="sideitem {{ Request::segment(1) == 'drop-box' ? 'active' : '' }}">
            <a href="{{ route('drop-box.index') }}">
                <i class="fab fa-dropbox"></i><span>Document Upload</span>            
            </a>
        </li>
        <li class="sideitem {{ Request::segment(1) == 'messages' ? 'active' : '' }}">
            <a href="{{ route('messages.index') }}">
                <i class="fa fa-comments"></i><span>Messages</span>
                @php
                    $unreadCount = \App\Models\Message::where('user_id', Auth::id())
                        ->where('sender_type', 'admin')
                        ->whereNull('read_at')
                        ->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge badge-danger">{{ $unreadCount }}</span>
                @endif
            </a>
        </li>
        <li class="sideitem {{ Request::segment(1) == 'mail' ? 'active' : '' }}">
            <a href="{{ route('mails') }}">
                <i class="fa fa-envelope-open"></i><span>Mail</span>            
            </a>
        </li>
        <li class="sideitem {{ Request::segment(2) == 'progress' ? 'active' : '' }}">
            <a href="{{ route('user.page', 'progress') }}">
                <i class="fa fa-file-alt"></i><span>Progress</span>            
            </a>
        </li>
        <li class="sideitem {{ Request::segment(2) == 'my-petition' ? 'active' : '' }}">
            <a href="{{ route('user.page', 'my-petition') }}">
                <i class="fa fa-file-alt"></i><span>My Petition</span>            
            </a>
        </li>
        <li class="sideitem {{ Request::segment(2) == 'profile' ? 'active' : '' }}">
            <a href="{{ route('user.page', 'profile') }}">
                <i class="fa fa-user"></i><span>Profile </span>            
            </a>
        </li>
        <li class="sideitem">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">
                    <i class="fa fa-sign-out-alt"></i><span>Logout</span>            
                </button>
            </form>
        </li>
    </ul>
</nav>