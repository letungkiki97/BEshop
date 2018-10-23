<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded  = array('id');
    protected $table = 'banner';

    public function images() {
    	return $this->belongsToMany(Image::class, 'banner_image', 'banner_id', 'image_id')->withPivot('link', 'text_text', 'text_color', 'text_font', 'text_size', 'text_left', 'text_right', 'text_top', 'text_bottom', 'button_background', 'button_text', 'button_color', 'button_font', 'button_size', 'button_left', 'button_right', 'button_top', 'button_bottom')->orderBy('position', 'asc');
    }
}
