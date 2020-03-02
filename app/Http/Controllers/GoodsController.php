<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Goods;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //商品分类
        $categoryInfo=Category::get();
        $info=$this->getCateInfo($categoryInfo);
        //品牌
        $brandInfo=Brand::get();
        $pageSize=config('app.pageSize');
        $goodsInfo=Goods::leftjoin('category','goods.cate_id','=','category.cate_id')
                        ->leftjoin('brand','goods.b_id','=','brand.b_id')
                        ->orderby('goods_id','desc')
                        ->paginate($pageSize);
        // dd($goodsInfo);
        //相册 
        foreach($goodsInfo as $k=>$v){
            $goodsInfo[$k]['goods_imgs']=explode('|',$v['goods_imgs']);
        } 
        return view('goods.index',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brandInfo,'info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //商品分类
        $categoryInfo=Category::get();
        $info=$this->getCateInfo($categoryInfo);
        //品牌
        $brandInfo=Brand::get();
        return view('goods.create',['brandInfo'=>$brandInfo,'info'=>$info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goodsInfo=$request->except('_token');
        // dd($goodsInfo);
        // 商品货号
        $goodsInfo['goods_code']=$this->CreateGoodsSn();
        //文件上传
        if ($request->hasFile('goods_img')) { 
            $goodsInfo['goods_img']=$this->upload('goods_img');
        }
        // 接收相册信息
        $files=$request->file('goods_imgs');
        // dump($files);die;
        $goods_imgs="";
        //$file指的是值
        foreach($files as $v){
            $goods_imgs.= $v->store('goods_imgs').'|';
        }
        //去除右边的|
        $goods_imgs=rtrim($goods_imgs,'|');
        // dump($goods_imgs);
        $goodsInfo['goods_imgs']=$goods_imgs;
        
        $res=Goods::insert($goodsInfo);

        // dd($res);
        if($res){
            return redirect('/goods');
        }
    }
    //文件上传
    public function upload($filename){
        //判断文件上传过程有无错误
        if (request()->file($filename)->isValid()){
            //接收值
            $photo= request()->file($filename);
            //上传
            $store_result = $photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    /**
     * 无限极分类
     */
    //$level等级，在视图页面根据等级决定输出多少个空格
   function getCateInfo($cateInfo,$pid=0,$level=1){
        if(!$cateInfo){
            return;
        }
        //将数据存到一个静态数组中，在函数执行完后，变量值仍保存
        static $info=[];
        foreach($cateInfo as $k=>$v){
            //如果pid等于0取出所有的顶级分类，我们不只是要取出顶级分类，还要取出顶级分类中的子类，需要将等于后面的值写活
            if($v['pid']==$pid){
                // print_r($v);
                $v['level']=$level;
                $info[]=$v;
                //刚刚已经查询到所有顶级的分类，调用自己，再查一遍，传数据，再传刚查到数据的分类id
                $this->getCateInfo($cateInfo,$v['cate_id'],$v['level']+1);
            }
        }
        //将数据返回
        return $info;
    }
    //产生货号
    public function CreateGoodsSn(){
        return 'shop'.date('YmdHis').rand(1000,9999);
    }
    /**
     * ajax验证唯一性
     */
    public function checkOnly(){
        $goods_name=request()->goods_name;
        // echo $atitle;
        $where=[];
        if($goods_name){
            $where[]=['goods_name','=',$goods_name];
        }
        $goods_id=request()->goods_id;
        // echo $atitle;
        if($goods_id){
            $where[]=['goods_id','!=',$goods_id];
        }
        $count=Goods::where($where)->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //商品分类
        $categoryInfo=Category::get();
        $info=$this->getCateInfo($categoryInfo);
        //品牌
        $brandInfo=Brand::get();
        $goodsInfo=Goods::find($id);
        return view('goods.edit',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brandInfo,'info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo $id;
        $goodsInfo=$request->except('_token');
        // dd($goodsInfo);
        
        //文件上传
        if ($request->hasFile('goods_img')) { 
            $goodsInfo['goods_img']=upload('goods_img');
        }
        // 接收相册信息
        $files=$request->file('goods_imgs');
        if($files){
             
            // dump($files);die;
            $goods_imgs="";
            //$file指的是值
            foreach($files as $v){
                $goods_imgs.= $v->store('goods_imgs').'|';
            }
            //去除右边的|
            $goods_imgs=rtrim($goods_imgs,'|');
            // dump($goods_imgs);
            $goodsInfo['goods_imgs']=$goods_imgs;
        }
       
        
        $res=Goods::where('goods_id',$id)->update($goodsInfo);

        // dd($res);
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Goods::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
