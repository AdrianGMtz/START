<nav>
    <div class="nav-wrapper black">
        <!-- Branding Image -->
        <a class="brand-logo" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
        <ul id="nav-mobile" class="right"> <!-- The navigation links are aligned to the right -->
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li><a href="/profile">{{ Auth::user()->name }}</a></li>
                <li><a href="/settings"> <i class="material-icons">settings</i> </a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>