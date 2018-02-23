<?php
$prefix = 'gg_';
/*--
* Funcion para la interfaz de oficina
--*/
function go_office_dashboard(){
?>
<style>
    .nav-tabs{
        border: none;
    }
    .nav-tabs > li{
        float: none;
        display: block;
    }
    .nav-tabs > li > a, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
        border-radius: 0px;
        border: none;
    }
</style>
<h1>Go Office</h1>
<div class="row">
    <div class="col-sm-2">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#contact" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-address-card-o" aria-hidden="true"></i> Contact Info</a></li>
        <li role="presentation"><a href="#socialprofiles" aria-controls="profile" role="tab" data-toggle="tab"><span class="fa fa-share-alt"></span> Social Media</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-plus" aria-hidden="true"></i> More</a></li>
    </ul>
        
    </div>
    <div class="col-sm-10">

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="contact">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Go Galapagos Main Office Address</h2>
<?php 
$tinyArgs = array(
    'textarea_rows'=>6, 
    'editor_class'=>'mytext_class',
    'textarea_name' => 'gogalapagosaddress'
);
$mytext_var="Some Text"; // this var may contain previous data that was stored in mysql.
wp_editor($mytext_var,"gogalapagos_office_address", $tinyArgs);
?>
                </div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="socialprofiles">
            <div class="row">
                <div class="col-sm-4">
                    <h2><span class="fa fa-share-alt"></span> Social Media Profiles</h2>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><span class="fa fa-facebook"></span> Facebook</label>
                        <input type="url" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><span class="fa fa-twitter"></span> Twitter</label>
                        <input type="url" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"><span class="fa fa-youtube"></span> Youtube</label>
                        <input type="url" class="form-control" id="exampleInputFile">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"><span class="fa fa-instagram"></span> Instagram</label>
                        <input type="url" class="form-control" id="exampleInputFile">
                    </div>         
                    <div class="form-group">
                        <label for="exampleInputFile"><span class="fa fa-google-plus"></span> Google Plus</label>
                        <input type="url" class="form-control" id="exampleInputFile">
                    </div>           
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="messages">...</div>
        <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
    </div>
    </div>
</div>
<?php
}
?>