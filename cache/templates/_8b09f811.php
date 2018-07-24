<?php defined('IN_MET') or exit('No permission'); ?>
<?php
    $type=strtolower(trim('current'));
    $cid=$data[classnow];
    $column = load::sys_class('label', 'new')->get('column');
    
    unset($result);
    switch ($type) {
            case 'son':
                $result = $column->get_column_son($cid);   
                break;
            case 'current':
                $result[0] = $column->get_column_id($cid);
                break;
            case 'head':
                $result = $column->get_column_head();
                break;
            case 'foot':
                $result = $column->get_column_foot();
                break;
            default:
                $result[0] = $column->get_column_id($cid);
                break;
        }
    $sub = count($result);
    foreach($result as $index=>$m):
        $hides = 1;
        $hide = explode("|",$hides);
        $m['_index']= $index;
        if($data['classnow']==$m['id'] || $data['class1']==$m['id'] || $data['class2']==$m['id']){
            $m['class']="";
        }else{
            $m['class'] = '';
        }
        if(in_array($m['name'],$hide)){
            unset($m['id']);
            unset($m['class']);
            $m['hide'] = $hide;
            $m['sub'] = 0;
        }
    

        if(substr(trim($m['icon']),0,1) == 'm' || substr(trim($m['icon']),0,1) == ''){
            $m['icon'] = 'icon fa-pencil-square-o '.$m['icon'];
        }
        $m['urlnew'] = $m['new_windows'] ? "target='_blank'" :"target='_self'";
        $m['_first']=$index==0 ? true:false;
        $m['_last']=$index==(count($result)-1)?true:false;
        $$m = $m;
?><?php endforeach;?>
    <?php if($data[classnow]==10001||!$ui[bgcolumn]||strstr('|'.strip_tags($ui[bgcolumn]).'|','|'.strip_tags($m[name]).'|')){ ?>
<section class="$uicss lazy <?php echo $ui['bgfull'];?>" m-id="<?php echo $ui['mid'];?>" data-title="<?php echo $ui['bgtitle'];?>" 
      <?php if($ui[bgimg] && !strstr($ui[bgimg],$c[met_agents_img])){ ?>data-background="<?php echo $ui['bgimg'];?>"<?php } ?>>

  <div class="multi-box">
    <div class="multi-cut">
      <h2 class="h2"><?php echo $ui['abouttitle'];?></h2> 
      <?php echo $ui['abouttext'];?>
          <?php if($ui[aboutmoreok]){ ?>
      <a class="multi-button" href="<?php echo $ui['aboutmorelink'];?>" title="<?php echo $ui['abouttitle'];?>"><?php echo $ui['aboutmorework'];?></a>
      <?php } ?>
    </div>
    <div class="multi-move     <?php if(!$ui[imagetype]){ ?>multi-fixed<?php } ?> ">
      <div class="multi-left"><i class="wb-chevron-left"></i></div>
      <div class="multi-right"><i class="wb-chevron-right"></i></div>
      <?php
    $cid=$ui[imgcolumn];

    $num = $ui[imgnumber];
    $module = "";
    $type = $ui[imgtype];
    $para = "";
    if(!$module){
        if(!$cid){
            $value = $m['classnow'];  
        }else{
            $value = $cid;
        }
    }else{
        $value = $module;
    }
   
    $result = load::sys_class('label', 'new')->get('tag')->get_list($value, $num, $type, $order, $para);
    $sub = count($result);
    foreach($result as $index=>$v):
        $id = $v['id'];
        $v['sub'] = $sub;
        $v['_index']= $index;
        $v['_first']= $index==0 ? true:false;
        $v['_last']=$index==(count($result)-1)?true:false;
        $$v = $v;
?>
      
          <?php if($v[_first]){ ?>
      
          <?php if($ui[imagetype]){ ?>
      <img src="<?php echo thumb($v['imgurl'],$ui[imgwidth],$ui[imgheight]);?>" style="width:100%; opacity:0; position:relative; z-index:1;" alt="<?php echo $v['title'];?>">
      <?php } ?>
      <div class="multi-wrapper">
      
      <?php } ?>
      
        <div class="multi-slide">
              <?php if($ui[imglinkok]){ ?>
          <a title="<?php echo $v['title'];?>" href="<?php echo $v['url'];?>" <?php echo $g['urlnew'];?>>
          <?php } ?>
          
          
          
            
            
            <span class="multi-lazy" data-background="<?php echo $v['imgurl'];?>"></span>
            
              <?php if($ui[imglinkok]){ ?>
          </a>
          <?php } ?>
        </div>
        
        
          <?php if($v[_last]){ ?>
      </div>
      <?php } ?>
      <?php endforeach;?>
      
      
    </div>
  </div>
  
</section>
<?php }else if($_GET[pageset]){ ?>
<section class="$uicss" m-id="<?php echo $ui['mid'];?>" m-type="nocontent" 
  style="background:#263238;max-height:40px;text-align:center;color:#fff;line-height:40px;display:block;border-bottom:1px solid #888;">
  该栏目设置了限制显示，可在“区块显示的栏目”中添加显示（该文字仅“可视化”模式下可见）
</section>
<?php } ?>