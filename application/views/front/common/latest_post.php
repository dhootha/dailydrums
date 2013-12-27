<?php 
$lp_whr = array('u.status'=>'1','dr.status'=>'1');
$latest_post   =  $this->Common_model->latest_post($lp_whr,0,3);
?>

<div class="clr"></div>
                <div class="latest_post">
                    <div class="row-fluid">
                        <div class="span12" style="padding-bottom: 10px !important ; ">
                            <div class="head">
                                <h2 class="title floatleft">LATEST POST</h2>
                                <a href="<?=base_url('welcome/latest_posts');?>" class="floatright">view all +</a>
                                <div class="clr"></div>                                
                            </div>
                            <ul >
                                <li class="active">
                                    <div class="img" style="height:150px; width:200px;"><img style="height:150px; width:200px;" src="<?php if($latest_post[0]->photo == null ) echo base_url('themes/front/images/no_image2.jpg'); else echo base_url('uploads/user_img/'.$latest_post[0]->photo); ?>" alt=""></div>
                                    <div class="info">
                                        <h2 class="red"><?=$latest_post[0]->display_name;?></h2>
                                        <p><?=$latest_post[0]->title;?></p>
                                        <p><?=substr($latest_post[0]->comment,0,200);?></p>
                                        <p><a href="<?=base_url('welcome/latest_posts/#'.$latest_post[0]->review_id);?>">Read more +</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img" style="height:150px; width:200px;"><img style="height:150px; width:200px;" src="<?php if($latest_post[1]->photo == null ) echo base_url('themes/front/images/no_image1.jpg'); else echo base_url('uploads/user_img/'.$latest_post[1]->photo); ?>" alt=""></div>
                                    <div class="info">
                                        <h2 class="red">Aliquam lorem ante olsa</h2>
                                        <p>06 February 2013 by Dani, in Entertainment</p>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mo...</p>
                                        <p><a href="#">Read more +</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img" style="height:150px; width:200px;"><img style="height:150px; width:200px;" src="<?php if($latest_post[2]->photo == null )echo base_url('themes/front/images/no_image1.jpg'); else echo base_url('uploads/user_img/'.$latest_post[2]->photo); ?>" alt=""></div>
                                    <div class="info">
                                        <h2 class="red">Aliquam lorem ante olsa</h2>
                                        <p>06 February 2013 by Dani, in Entertainment</p>
                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mo...</p>
                                        <p><a href="#">Read more +</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
