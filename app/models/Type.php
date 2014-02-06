<?php

class Type extends Eloquent {
	protected $guarded = array();

    protected $softDelete = true;

	public static $rules = array(
		'name' => 'required|unique:types,name'
	);
    public function properties()
    {
        return $this->hasMany('Property');
    }
    public static function update_rules($id)
    {
        return array('name' => 'required|unique:types,name,'.$id);
    }
    public static function got_property($id)
    {
        $property = Property::where('type_id','=',$id);
        if($property->count() > 0){ return true; }else{ return false;}
    }
    public static function dropdown($novalue = null)
    {
        $locations = Type::orderBy('name')->get();
        $array = [];
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
