<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Commission;

use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

class CommissionController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth')->except(['index', 'show']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$photography_commissions = Commission::where('type', 'Photography')->paginate(8);
		$digital_commissions = Commission::where('type', 'Digital Art')->paginate(8);
		$sketch_commissions = Commission::where('type', 'Sketch')->paginate(8);

		return view('index', compact('photography_commissions', 'sketch_commissions', 'digital_commissions'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($commission_id) {
		$user = Commission::find($commission_id)->user;

		$commission = Commission::find($commission_id);
		
		return view('commissions.details', compact('user', 'commission'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		// Validate form
		$this->validate(request(), [
			'description' => 'required|min:3',
			'type' => 'required',
			'price' => 'required',
			'images' => 'required',
			'images.*' => 'image|mimes:jpeg,png|dimensions:min_width=300,min_height=300,max_width=1800,max_height=1200'
		]);

		// Create new post
		$commission = new Commission(request(['description', 'type', 'price']));

		auth()->user()->publish($commission);

		$files = request()->file('images');

		$count = 1;

		foreach ($files as $file) {
			Storage::disk('google')->put('commission_' . $commission->id . '_' . $count, file_get_contents($file));
			$count++;
		}

		// return view
		return redirect('/profile');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Commission $commission) {
		$current_user = auth()->user()->id;
		$commission_user = $commission->user_id;

		// Validate form
		$this->validate(request(), [
			'description' => 'required|min:2',
			'type' => 'required',
			'price' => 'required'
		]);

		if ($current_user == $commission_user) {
			$commission->description = request('description');
			$commission->type = request('type');
			$commission->price = request('price');

			$commission->save();

			// return view
			return redirect('/profile');
		}
	   abort(403, 'Unauthorized action.');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Commission $commission) {

		return view('commissions.edit', compact('commission'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Commission $commission) {
		$current_user = auth()->user()->id;
		$commission_user = $commission->user_id;

		if ($current_user == $commission_user) {
			Commission::destroy($commission->id);

			return redirect('/profile');
		}
		abort(403, 'Unauthorized action.');
	}
}
