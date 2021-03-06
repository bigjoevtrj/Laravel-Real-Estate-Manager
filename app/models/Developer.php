<?php

class Developer extends Eloquent {
	protected $guarded = array();

    protected $softDelete = true;

	public static $rules = array(
		'name' => 'required',
        'email'=> 'required',
	);
    public function properties()
    {
        return $this->hasMany('Property');
    }
    public static function update_rules($id)
    {
        return array(
            'name' => 'required',
            'email'=> 'required',
        );
    }

    public static function got_property($id)
    {
        $property = Property::where('developer_id','=',$id);
        if($property->count() > 0){ return true; }else{ return false;}
    }

    public static function dropdown($novalue = null)
    {
        $locations = Developer::orderBy('name')->get();
         $array = array();
        if($novalue)
        {
            $array = array(
                '' => 'Any'
            );
        }
       
        foreach($locations as $l)
        {
            $key = $l->id;
            $array[$key] = ucwords($l->name);
        }
        return $array;
    }
}
