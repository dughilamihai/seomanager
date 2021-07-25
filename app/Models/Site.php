<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Translatable\HasTranslations;


class Site extends Model
{
    use CrudTrait;
    use HasTranslations;    

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sites';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'is_active',       
        'is_dofollow',  
        'is_free',  
        'name',
        'slug',    
        'user_id',              
        'description',  
        'url',                        
        'meta_title', 
        'meta_description', 
        'cover',
        'spam', 
        'pa', 
        'da', 
        'total_links', 
        'contact_sent',                                            
        'contact_response',  
        'about_response', 
        'price',  
        'analytics',  
        'category_id',
        'website_type_id',      
        'language_id',                                                 
    ];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['name','description','meta_title','meta_description','about_response'];     

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function website_type()
    {
        return $this->belongsTo(WebsiteType::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
        $this->attributes['user_id'] = 3;        
    }    

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
        $str = preg_replace('#^https?://#', '', $value);
        $this->attributes['slug'] = \Str::slug($str, '-');    
    }    

    public function setCoverAttribute($value)
    {
        $attribute_name = "cover";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name'); 
        // destination path relative to the disk above
        $destination_path = "public/uploads/images/cover"; 

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            $image->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it 
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }

    public function setAnalyticsAttribute($value)
    {
        $attribute_name = "analytics";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name'); 
        // destination path relative to the disk above
        $destination_path = "public/uploads/images/analytics"; 

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it 
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }
}
