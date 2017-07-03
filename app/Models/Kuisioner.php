<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    protected $table = 'kuisioner';
    protected $fillable = ['pasien_id','k1','k2','k3','k4','k5','k6','k7','k8','k9','k10','k11','k13','k14','k15','k16','k17','k18','k19','k20','k21','k22','k23','k24','k25','k26','k27','k28','k29','k30','k31a','k31b','k31c','k31d','k31e','k31f','k31g','k31h','k31i','k31j','k31k','k32','k33','k34','k35','k36','k37','k38','k39','k40','k41','k42','k43a','k43b','k44','k45','k46','k47','k48','k49','k50a','k50b','k50c','k51','k52','k53','k54','k55','k56','k57','k58','k59','k60','k61','k62','k63','k64','k65','k66a','k66b','k67','k68a','k68b','k69','k70','k71','k72','k73','k74','k75a','k75b','k76','k77a','k77b','k78','k79','k80','k81','k82','k83','k84','k85','k86','k87','k88','k89','k90','k91','k92','k93','k94','k95','k96','k97'];

    public function pasien()
    {
    	return $this->belongsTo('Labmanager\Models\Pasien');
    }
}
