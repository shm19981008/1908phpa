<?php
//无限极分类
 // function getcateinfo($cateinfo,$pid=0,$level=1){
 //        static $info=[];
 //        // if(!$cateinfo){
 //        //     return;
 //        // }
 //        foreach($cateinfo as $k=>$v){
 //            if($v['pid']==$pid){
 //                $v['level']=$level;
 //                $info[]=$v;
 //                getcateinfo($cateinfo,$v['cate_id'],$v['level']+1);
 //            }
 //        }
 //        return $info;
 //    }
  //文件上传
 function uploads($filename){
        //判断上传有无错误
        if (request()->file($filename)->isValid()){
            //接收值
            $photo = request()->file($filename);
            //上传
            $store_result = $photo->store('uploads');
            return $store_result;
           }
        exit('未获取到上传文件或上传过程出错');
    }
  function getcateinfo($cateinfo,$pid=0,$level=1){
        if( !$cateinfo){
            return;
        }
        static $info = [];
        foreach($cateinfo as $k=>$v){
            if($v->pid == $pid){
                $v->level = $level;
                $info[] =$v;

                //调用自身
                getcateinfo($cateinfo,$v->cate_id,$level+1);
            }
        }

        return $info;

    }
    //多文件上传
    function Moreuploads($filename){
        $photo=request()->file($filename);
        if(!is_array($photo)){
            return;
        }
        foreach($photo as $v){
            if($v->isValid()){
                $store_result[]=$v->store('uploads');
            }
        }
        return $store_result;
    }