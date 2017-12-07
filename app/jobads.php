<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class jobads extends Model
{
    protected $guarded = [];


    public function getJobBeginDateAttribute($value){
      return Carbon::createFromTimestamp((int)str_replace(['/Date(',')'],['',''],$value) / 1000);
    }

    public function getApplicationdeadlineAttribute($value){
      return Carbon::createFromTimestamp((int)str_replace(['/Date(',')'],['',''],$value) / 1000);
    }

    public function prettyDescription(){
      $content = nl2br($this->description);

        $_temp = explode('<br />', $content);


        $returnContent = '<p>';
        $returnContent .= implode('</p><p>', $_temp);
        $returnContent .= '</p>';

        return $returnContent;
    }

    public function prettyFooter(){
      $content = nl2br($this->footer);

      $_temp = explode('<br />', $content);


      $returnContent = '<p>';
      $returnContent .= implode('</p><p>', $_temp);
      $returnContent .= '</p>';

      return $returnContent;
    }
}
