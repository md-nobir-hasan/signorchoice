<?php

function splitPhoto($photo){
    if($photo){
        return explode(',https',$photo);
    }
    return asset('images/default/all.webp');
}

function photoFirst($photo){
    return splitPhoto($photo)[0];
}
