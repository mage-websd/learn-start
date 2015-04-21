<?php
class SM_CommentFacebook_Models_Option_Order
{
    public function toOptionArray()
    {
        return array(
            array('label'=>'Social','value'=>'social'),
            array('label'=>'Time Descending','value'=>'reverse_time'),
            array('label'=>'Time Ascending','value'=>'time'),
        );
    }
}