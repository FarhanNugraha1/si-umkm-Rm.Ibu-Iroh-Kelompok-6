<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantProfileModel extends Model
{
    protected $table            = 'restaurant_profiles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_restoran',
        'sejarah',
        'alamat',
        'jam_operasional',
        'telepon',
        'whatsapp',
        'map_embed_url',
        'map_link',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
