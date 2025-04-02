<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Volunteer extends Model
{
    protected $fillable = [
        'full_name', 'birth_date', 'phone', 'nationality', 'gender',
        'country', 'city', 'occupation', 'email', 'previous_volunteer', 'how_heard',
         "volunteer_experience", "national_id"
    ];

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(VolunteerProgram::class, 'volunteer_program_enrollments', 'volunteer_id', 'program_id');
    }
}

