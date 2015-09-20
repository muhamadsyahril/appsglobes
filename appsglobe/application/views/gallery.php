<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APPS GLOBES | Gallery</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo CSS_BASE_URL;?>/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo CSS_BASE_URL;?>/sb-admin.css" rel="stylesheet">

    <link href="<?php echo CSS_BASE_URL;?>/style.css" rel="stylesheet">

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
                           GALLERY
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                <!-- FORM input -->
                <form role="form" method="post" name="form1" id="form1" action="<?php echo base_url('gallery/save');?>">
                        
                    
                             <div class="form-group">
                                <label>Upload Gallery</label>
                                <div style="margin-bottom:10px;" class="imageurl"></div>
                                <input type="text" name="imageGallery" readonly="readonly" style="width:400px;" id="imageurl" class="form-control input-sm" value="">
                                <span class="help-block" style="margin-bottom:0px;">width and height optimal is 400px x 400px</span>
                                <div style="margin-right:10px;">
                                    <a onClick="openKCFinder('imageurl');" id="link-file" class="link">Browse</a>
                                    <a onClick="reset_value('imageurl');" id="link-file" class="link">Reset</a>
                                </div>
                            </div>


                            <div style="margin-top:10px;">
                                <input name="tbSave" id="tbSave" class="btn btn-default" type="submit" value="Save">
                            </div>
                </form>

                <br /><br />



               <div class="row">

                <?php foreach ($listGallery as $key => $value) {
                    
                    $id = $value->id;
                    $image = base_url().$value->image_path;
                ?>
                  <div class="col-xs-6 col-md-3 tumb_<?php echo $id ?>">
                    <a class="close" href="#" onclick="_delTumbnail(<?php echo $id; ?>)">×</a>
                    <a href="#" class="thumbnail">
                      <img src="<?php echo $image; ?>" alt="tumb">
                    </a>
                  </div>
                  <?php } ?>
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
    <script src="<?php echo JS_BASE_URL;?>/script.js"></script>

    <!-- Morris Charts JavaScript -->
    <!--<script src="<?php echo JS_BASE_URL;?>/plugins/morris/raphael.min.js"></script>
    // <script src="<?php echo JS_BASE_URL;?>/plugins/morris/morris.min.js"></script>
    // <script src="<?php echo JS_BASE_URL;?>/plugins/morris/morris-data.js"></script> -->

</body>

</html>
