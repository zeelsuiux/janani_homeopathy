<?php require 'header.php'; $db=db_load(); $id=get('id'); $db['gallery']=array_values(array_filter($db['gallery'],fn($g)=>$g['id']!==$id)); db_save($db); redirect('gallery.php');
