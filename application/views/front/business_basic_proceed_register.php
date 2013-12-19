<script type="text/javascript">

 function select_plan() {
 	
 			if($('input:radio[name=plan]:checked').val()){
 				
 				return true;
 				}
 				else{
 					alert("Please select a plan");
 					return false;
 					}
 	}
</script>
<!--Start Content-->
        <div class="container-fluid">
            <div class="main_container">
            	<div class="main_head">
	            	<h2 class="title p_top50 floatleft">Bussiness Basic</h2>
                    <div class="floatright call_right">
                    	<p class="blue2">Need help ordering? 866 - </p>
                        <p class="red">Monday - Friday, 7 a.m. - 5 p.m. PT</p>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="row-fluid basic_register">
                    <div class="span8">
                    	<div class="service_term">
                        	<div class="head">
                        		<div class="row-fluid">
                                	<div class="span6">
                                    	<div class="font16 blue font_type1">Select Service Term</div>
                                    </div>
                                    <div class="span3">
                                    	<div class="font16 blue font_type1">Term Savings</div>
                                        <div class="red italic">Save with a longer term.</div>
                                    </div>
                                    <div class="span3">
                                    	<div class="font16 blue font_type1">Special Offer</div>
                                        <div class="italic">Save even more!</div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                            </div>
                            <div class="content">   
                            		<form name="business_plan" action="<?=base_url('registration');?>" method="post" onsubmit="return select_plan();" >                          
                                <div class="row-fluid">
                                    <div class="rows">
                                        <div class="span4"><input type="radio" name="plan" value="1"> 1 Months</div>
                                        <div class="span1">$</div>
                                        <div class="span1">/mo</div>
                                        <div class="span3 red">---</div>
                                        <div class="span3">---</div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="rows">
                                        <div class="span4"><input type="radio"  name="plan" value="3"> 3 Months</div>
                                        <div class="span1">$</div>
                                        <div class="span1">/mo</div>
                                        <div class="span3 red">---</div>
                                        <div class="span3">---</div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="rows">
                                        <div class="span4"><input type="radio"  name="plan" value="6"> 6 Months</div>
                                        <div class="span1">$</div>
                                        <div class="span1">/mo</div>
                                        <div class="span3 red">---</div>
                                        <div class="span3">---</div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="rows">
                                        <div class="span4"><input type="radio"  name="plan" value="12"> 12 Months</div>
                                        <div class="span1">$</div>
                                        <div class="span1">/mo</div>
                                        <div class="span3 red">---</div>
                                        <div class="span3">---</div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="floatleft"><a class="blue" href="#">Learn more &raquo;</a></div>
                                    <div class="floatright"><a class="blue" href="#">Pricing details &raquo;</a></div>
                                    <div class="clr"></div>
                                    <p class="align-right"><input type="submit" class="blue_btn1" name="submit" value="Proceed to order"></p>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                    	<div class="service_term">
                        	<div class="head">
                        		<div class="font16 blue font_type1">Basic Package Key Features</div>
                                <div class="">&nbsp;</div>
                            </div>
                            <div class="content">                            
                                <ul class="bullet3">
                                	<li>Unlimited Postings</li>
                                    <li>Basic Posting with one image Display</li>
                                </ul>
                          <ul class="bullet4">
                                	<li><a class="blue" href="pricing-new2.html">Pricing</a></li>
                                    <li><a class="blue" href="pricing-new2.html">Sample Posting</a></li>
                                </ul>
                              <p><a class="blue_btn1" href="<?=base_url('registration');?>">Business Basic</a></p>
                            </div>
                      </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <!--End Content-->