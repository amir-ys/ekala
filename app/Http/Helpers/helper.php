<?php



if (!function_exists('newFeedback')){
    function newFeedback($title  = null , $body = 'عملیات با موفقیت انجام شد' , $type = 'success'){
      $title =  is_null($title) ?  'موفقیت آمیز' : $title ;
      $body =  is_null($body) ?  'عملیات با موفقیت انجام شد'  : $body ;
        $session = session()->has('feedbacks') ? session()->get('feedbacks') : [];
        $session[] = ['title' => $title, 'body' => $body, 'type' => $type];
        session()->flash('feedbacks', $session);
    }

    if (!function_exists('createCarbonFormatFromPersian')){
        function createCarbonFormatFromPersian ($date , $format = 'Y-m-d h:i'  ){
            return Morilog\Jalali\Jalalian::fromFormat($format , $date )->toCarbon();
        }
    }
}
