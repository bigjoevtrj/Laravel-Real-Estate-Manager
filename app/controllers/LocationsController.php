<?php

class LocationsController extends BaseController {

	/**
	 * Location Repository
	 *
	 * @var Location
	 */
	protected $location;

	public function __construct(Location $location)
	{
		View::share('page_title','Locations');

        $this->location = $location;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locations = $this->location->all();

		return View::make('admin.locations.index', compact('locations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.locations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Location::$rules);

		if ($validation->passes())
		{
			$this->location->create($input);

			return Redirect::route('admin.locations.index');
		}

		return Redirect::route('admin.locations.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$location = $this->location->findOrFail($id);

		return View::make('admin.locations.show', compact('location'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$location = $this->location->find($id);

		if (is_null($location))
		{
			return Redirect::route('admin.locations.index');
		}

		return View::make('admin.locations.edit', compact('location'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input,Location::update_rules($id));

		if ($validation->passes())
		{
			$location = $this->location->find($id);
			$location->update($input);

			return Redirect::route('admin.locations.show', $id);
		}

		return Redirect::route('admin.locations.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(Location::got_property($id) == false)
        {
            $this->location->find($id)->delete();
        }
		return Redirect::route('admin.locations.index');
	}

}
