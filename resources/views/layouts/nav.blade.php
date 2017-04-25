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
				<li><a href="/messages">Chat <span class="material-icons">forum</span></a></li>
				<li><a href="/orders">Orders <span class="material-icons">description</span></a></li>
				<li><a href="/settings"> <span class="material-icons">settings</span> </a></li>
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

{{-- Dropdown menu --}}
{{-- <ul id="menu_dropdown" class="dropdown-content">
	<li><a href="#!">Settings</a></li>
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
</ul>
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
				<li><a class="dropdown-button" href="#!" data-activates="menu_dropdown"><i class="material-icons right">arrow_drop_down</i></a></li>
			@endif
		</ul>
	</div>
</nav> --}}
>>>>>>> c801e6314d35a25f48fa76b26abbb5030e398747
