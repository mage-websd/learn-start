<?php
class SM_CommentFacebook_Models_Option_Colorscheme
{
    public function toOptionArray()
    {
        return array(
            array('label'=>'Light','value'=>'light'),
            array('label'=>'Dark','value'=>'dark'),
        );
    }
}