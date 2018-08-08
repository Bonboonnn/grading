<!DOCTYPE html>
<html>
	
    <head>
        <?php include_once '../link-file/head.php'; ?>
        
        <?php include_once '../link-file/foot-js.php'; ?>
		
		<style>
			.dataTables_filter {
				display: none;
			}
			
			.yes_print {
				display: none;
			}
		</style>
		
		<style type="text/css" media="print">
			.dataTables_filter, .dataTables_length, .dataTables_paginate, .dataTables_info {
				display: none;
			}
			
			.box {
				border-top: 1px solid white !important;
			}
			
			.yes_print {
				display: block;
			}
		</style>
		
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
                
            <?php include_once '../link-file/header.php'; ?>
            
            <?php include_once '../link-file/side-bar.php'; ?>
            <div class="content-wrapper">
                <section class="content-header"></section>
                <section class="content"></section>
            </div>
            <div class="control-sidebar-bg"></div>
        </div>
    </body>
</html>
