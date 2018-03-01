<!DOCTYPE html>

<html>

    <head>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/style.css">

        <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/directorylister.js"></script>

        <!-- FONTS -->
        <link rel="stylesheet" type="text/css"  href="//fonts.googleapis.com/css?family=Cutive+Mono">

        <!-- META -->
       
        <meta charset="utf-8">


        <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/directorylister.js"></script>
        <script>
            $('#delete_button').click(function(){
                var comment_id = $(this).attr('id');//you should use the id of the comment as id for the delete button for this to work.
              alert(comment_id);
              //  $.post('delete.php', {'comment_id' : comment_id}, function(){
                //   $(this).parent('div').remove(); //hide the comment from the user
               // });
             });
        </script>
     
    </head>

    <body>

        

        <div id="page-content" class="">

            <?php file_exists('header.php') ? include('header.php') : include($lister->getThemePath(true) . "/default_header.php"); ?>

            <?php if($lister->getSystemMessages()): ?>
                <?php foreach ($lister->getSystemMessages() as $message): ?>
                    <div class="alert alert-<?php echo $message['type']; ?>">
                        <?php echo $message['text']; ?>
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div id="directory-list-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-10">File</div>
                    <div class="col-md-1 col-sm-2 col-xs-2 text-right">Size</div>
                    <div class="col-md-3 col-sm-4 hidden-xs text-right">Last Modified</div>
                    <div class="col-md-1 col-sm-4 hidden-xs text-right">Delete</div>
                </div>
            </div>

            <ul id="directory-listing" class="nav nav-pills nav-stacked">

                <?php foreach($dirArray as $name => $fileInfo): ?>
                    <li data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
               <?php //var_dump($fileInfo); ?>
                        <a href="<?php echo $fileInfo['url_path']; ?>" class="clearfix" data-name="<?php echo $name; ?>">

                    <div class="row">
                        <span class="file-name col-md-6 col-sm-6 col-xs-9">
                            <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
                            <?php echo $name; ?>
                        </span>

                        <span class="file-size col-md-1 col-sm-2 col-xs-3 text-right">
                            <?php echo $fileInfo['file_size']; ?>
                        </span>

                        <span class="file-modified col-md-3 col-sm-4 hidden-xs text-right">
                            <?php echo $fileInfo['mod_time']; ?>
                        </span>
                        <?php
                         if($fileInfo['icon_class']!='fa-level-up')
                         {
                            
                         
                        echo "<object><a id='delete' class='clearfix' href='delete.php?id={$fileInfo['file_path']}' data-name='$name'>
                        <span class='file-modified col-md-1 col-sm-4 hidden-xs text-right'>
                            <span class='glyphicon glyphicon-remove' style='color:#FF0000;' aria-hidden='true'></span>
                        </span>
                        </a></object>";
                        }
                         ?>       
                    </div>   

                        </a>
                        

                        <?php if (is_file($fileInfo['file_path'])): ?>

                            <!--a href="javascript:void(0)" class="file-info-button">
                                <i class="fa fa-info-circle"></i>
                            </a-->

                        <?php else: ?>

                            <?php if ($lister->containsIndex($fileInfo['file_path'])): ?>

                                <a href="<?php echo $fileInfo['file_path']; ?>" class="web-link-button" <?php if($lister->externalLinksNewWindow()): ?>target="_blank"<?php endif; ?>>
                                    <i class="fa fa-external-link"></i>
                                </a>

                            <?php endif; ?>

                        <?php endif; ?>

                    </li>
                <?php endforeach; ?>

            </ul>
        </div>

        <?php file_exists('footer.php') ? include('footer.php') : include($lister->getThemePath(true) . "/default_footer.php"); ?>

        <div id="file-info-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{modal_header}}</h4>
                    </div>

                    <div class="modal-body">

                        <table id="file-info" class="table table-bordered">
                            <tbody>

                                <tr>
                                    <td class="table-title">MD5</td>
                                    <td class="md5-hash">{{md5_sum}}</td>
                                </tr>

                                <tr>
                                    <td class="table-title">SHA1</td>
                                    <td class="sha1-hash">{{sha1_sum}}</td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </body>

</html>
