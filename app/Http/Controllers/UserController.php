<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

use App\User;
use App\Commission;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth')->except(['showArtist']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show() {
		$user = User::find(auth()->user()->id);

		$photography_commissions = Commission::latest()->where([['type', 'Photography'],['user_id', $user->id]])->paginate(8);
		$digital_commissions = Commission::latest()->where([['type', 'Digital Art'],['user_id', $user->id]])->paginate(8);
		$sketch_commissions = Commission::latest()->where([['type', 'Sketch'],['user_id', $user->id]])->paginate(8);

		return view('profile.show', compact('user', 'photography_commissions', 'digital_commissions', 'sketch_commissions'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showArtist(User $profile) {
		$result = User::where([['artist', true],['id', $profile->id]])->get();
		
		if (!$result->isEmpty()) {
			$user = $result[0];

			$current_user = auth()->user()->id;

			if ($user->id != $current_user) {
				$photography_commissions = Commission::latest()->where([['type', 'Photography'],['user_id', $user->id]])->paginate(8);
				$digital_commissions = Commission::latest()->where([['type', 'Digital Art'],['user_id', $user->id]])->paginate(8);
				$sketch_commissions = Commission::latest()->where([['type', 'Sketch'],['user_id', $user->id]])->paginate(8);

				return view('profile.show', compact('user', 'photography_commissions', 'digital_commissions', 'sketch_commissions'));
			}
		}

		return redirect('/profile');
	}

	public function becomeArtist() {

		// Create new post
		$user = auth()->user();
		$user->artist = true;
		$user->save();

	 	// return view
		return redirect('/profile');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit() {
		$user = auth()->user();

		return view('profile.edit', compact('user'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('profile.create');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store() {
		// Validate form
	 	$this->validate(request(), [
	 		'description' => 'required|min:2',
            'avatar' => 'image|mimes:jpeg,png|dimensions:min_width=200,min_height=300,max_width=1000,max_height=1200'
	 	]);

	 	// Create new post
		$user = auth()->user();
		$user->description = (request('description'));
		$user->save();

		// Update profile picture if file was uploaded
		if (!empty(request()->file('avatar'))) {
			$this->saveAvatar();
			// Storage::disk('google')
			// 	->put('profile_' . auth()->id(),
			// 		file_get_contents(request()->file('avatar'))
			// 	);
		}

	 	// return view
		return redirect('/profile');
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAvatar() {
		Storage::disk('google')
			->put('profile_' . auth()->id(),
				file_get_contents(request()->file('avatar'))
			);
    }
}
