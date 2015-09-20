<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APPS GLOBES | Data Paket</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo CSS_BASE_URL;?>/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo CSS_BASE_URL;?>/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo CSS_BASE_URL;?>/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo FONT_AWESOME;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- ckeditor and kcfinder -->
    <script src="<?php echo TOOLS_BASE_URL; ?>/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
    function openKCFinder(field) {
        window.KCFinder = {
            callBack: function(url) {
                document.getElementById(field).value = url;
                $( "."+field ).html('<img src="'+url+'" style="max-width:400px; padding:5px; border:solid 1px #ccc;">');
                window.KCFinder = null;
            }
        };
        window.open('<?php echo TOOLS_BASE_URL; ?>/kcfinder/browse.php?type=images', 'kcfinder_textbox',
            'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
            'resizable=1, scrollbars=0, width=800, height=600'
        );
    }
    </script>
    <!-- end ckeditor and kcfinder -->

    <script>

     window.onload = function() {
        $('#form1').hide();
        $("#tbAdd").click(function(){
            $('#form1').toggle("slow");
        });

         $("#tbSave").click(function(){
           alert("save");
        });

    }

    </script>


</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">APPS GLOBES</a>
            </div>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="<?php echo base_url('home'); ?>"><i class="fa fa-fw fa-dashboard"></i>Paket</a>
                        <a href="<?php echo base_url('gallery'); ?>"><i class="fa fa-fw fa-dashboard"></i>Gallery</a>
                    </li>
                  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           PAKET
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                <!-- FORM input -->
                <form role="form" method="post" name="form1" id="form1" action="<?php echo base_url('home/save');?>">
                        
                            <div class="form-group">
                                <label>Nama Paket</label>
                                <input name="paketname" type="text" class="form-control input-sm" placeholder="" style="width:300px;" value=""> 
                            </div>
                            
                            <div class="form-group">
                                <label>Deskripsi</label><br/>
                                <input name="diskripsi" type="text" class="form-control input-sm" style="width:300px;" value="">
                            </div>

                             <div class="form-group">
                                <label>Paket Image</label>
                                <div style="margin-bottom:10px;" class="imageurl"></div>
                                <input type="text" name="imagepaket" readonly="readonly" style="width:400px;" id="imageurl" class="form-control input-sm" value="">
                                <span class="help-block" style="margin-bottom:0px;">width and height optimal is 400px x 400px</span>
                                <div style="margin-right:10px;">
                                    <a onClick="openKCFinder('imageurl');" id="link-file" class="link">Browse</a>
                                    <a onClick="reset_value('imageurl');" id="link-file" class="link">Reset</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input name="harga" type="text" class="form-control input-sm" style="width:200px;" value="">
                            </div>

                            <div style="margin-top:10px;">
                                <input name="tbSave" id="tbSave" class="btn btn-default" type="submit" value="Save">
                            </div>
                </form>

                    <br/><br/>
                   <!-- TABLE DATA   -->   
               
            <div style="width:100%px;margin:0 auto;">
                 <div style="margin-top:10px; margin:20px;">
                        <input name="tbAdd" id="tbAdd" class="btn btn-primary" type="submit" value="Add">
                 </div>


                <div class="panel panel-primary">
                           
                    <div class="panel-heading">
                      <h3 class="panel-title">List Paket</h3>
                    </div>
                   
                    <div class="panel-body">
                        <div class="table-responsive" style="margin-top:10px;">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5">No</th>
                                        <th>Nama Paket</th>
                                        <th>Diskripsi</th>
                                        <th>Image</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <form name="formAssignment2" method="POST" onsubmit="return false;">
                                    <?php
                                    $no=0;
                                    foreach($listpaket as $v){
                                        $no++;
                                    ?>
                                    <tr>
                                        <input type="hidden" name="paketid[<?php echo $v['paket_id'];?>]" id="paketid" value="<?php echo $v['paket_id'];?>">
                                        <td width="5"><?php echo $no;?></td>
                                        <td><?php echo $v['nama_paket'];?></td>
                                        <td><?php echo $v['diskripsi'];?></td>
                                        <td><?php 
                                        $product_image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$v['image_path']);
                                        $product_image = BASE_URL.$v['image_path'];
                                        ?>
                                        <a id="viewBackend2" href="#viewDataImage<?php echo $v['paket_id'];?>">
                                            <img src="<?php echo $product_image_thumbs;?>">
                                        </a>
                                        <div style="display: none;">
                                            <div id="viewDataImage<?php echo $v['paket_id'];?>">
                                                <img src="<?php echo $product_image;?>" >
                                            </div>
                                        </div>
                                        </td>
                                        <td><?php echo $v['harga'];?>
                                            
                                            <a id="dell" class="pull-right btn btn-danger" href="<?php echo base_url().'home/delete/'.$v['paket_id'] ?>">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </form>
                                </tbody>
                            </table>
                        </div>
                        <?php echo($paging); ?>
                    </div>
                </div>
            </div>


                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo JS_BASE_URL;?>/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo JS_BASE_URL;?>/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo JS_BASE_URL;?>/plugins/morris/raphael.min.js"></script>
    <script src="<?php echo JS_BASE_URL;?>/plugins/morris/morris.min.js"></script>
    <script src="<?php echo JS_BASE_URL;?>/plugins/morris/morris-data.js"></script>

</body>

</html>
