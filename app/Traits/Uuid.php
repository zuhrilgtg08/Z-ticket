<?php

namespace App\Traits;

use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Uuid as Generator;

trait Uuid
{
    protected static function boot ()
    {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(function ($model) {
            try {
                $model->uuid = Generator::uuid4()->toString();
            } catch (UnsupportedOperationException $th) {
                abort(500, $th->getMessage());
            }
        });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing ()
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType ()
    {
        return 'string';
    }
}