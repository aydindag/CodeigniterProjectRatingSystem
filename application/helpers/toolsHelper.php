<?php

function imageupload($name,$path)
{
    $ci=get_instance();
    $config['upload_path'] = 'assets/upload/'.$path;
    $config['allowed_types']= 'gif|jpg|png';
    $ci->upload->initialize($config);
    if($ci->upload->do_upload($name))
    {
        $image=$ci->upload->data();
        return $config['upload_path'].$image['file_name'];
    }
    
    
}

?>