<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;
use App\Events\CourseCreatedEvent;
use App\Events\CourseDeletedEvent;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
//    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','professor_id', 'start_date', 'end_date'
    ];

    public function users(){
        //return $this->belongsToMany(User::class,'course_user','course_id','user_id');
        return $this->belongsToMany(User::class);
    }

    public function professor(){
        return $this->belongsTo(User::class, 'professor_id' );
    }

    public function reviews()
    {
        return $this->morphMany(Review::class,'reviewable');
    }


    public function calculateAverageCourseRate(){
        if($this->reviews()){
            $rateSum = 0;
            foreach($this->reviews as $review){
                $rateSum += $review->rate;
            }
            $averageRate = $rateSum/$this->reviews->count();
            $averageRate = round($averageRate,2);
            return $averageRate;
        }
    }



    public $dispatchesEvents = [

        'deleted' => CourseDeletedEvent::class,
        'created' => CourseCreatedEvent::class

    ];




    public static function boot() {
        parent::boot();

        static::deleted(function($course) {
            $course->reviews()->delete();
        });
    }

}
