<?php
    if ( ! defined( 'ABSPATH' ) ) {
        die;
    }
    
    $learn_soc_arr = get_my_learn_soc_array();
    $learn_up_errors = []; // Store all errors here
    foreach ($learn_soc_arr as $learn_soc) {
        $learn_soc_name = $learn_soc['social_name'];
        $learn_upload_name = $learn_soc_name .  '_learn_file_upload';
        
        if($_FILES[$learn_upload_name]['name'] != ''){
           
            $fileName = $_FILES[$learn_upload_name]['name'];
            $fileSize = $_FILES[$learn_upload_name]['size'];
            $fileTmpName  = $_FILES[$learn_upload_name]['tmp_name'];
            $fileType = $_FILES[$learn_upload_name]['type'];
            
            $tmp_explode = explode('.', $fileName);
            $fileExtension = strtolower(end($tmp_explode));
            $fileExtensions = ['png', 'jpg', 'jpeg', 'gif']; // Get all the file extensions
            $uploadPath = plugin_dir_path(__FILE__) . 'icons/' . basename($fileName); 
            $learn_up_url = plugin_dir_url(__FILE__) . 'icons/' . basename($fileName);

            if (! in_array($fileExtension,$fileExtensions)) {
                $learn_up_errors[] = '<p>The file ' . $fileName . '  extension is not allowed. Please upload a PNG/JPG/JPEG/GIF file</p>';
            }
    
            if ($fileSize > 2000000) {
                $learn_up_errors[] = '<p>The file ' . $fileName . ' is more than 2MB. Sorry, it has to be less than or equal to 2MB</p>';
            }
            if(file_exists($uploadPath)){
                $learn_up_errors[] = '<p> FILE NAME ' . $fileName . '  IS EXIST <p>';
            }
            if (empty($learn_up_errors)) {
                $learn_didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                if ($learn_didUpload) {
                    $learn_soc_array = get_my_learn_soc_array();
                    $learn_soc_array[$learn_soc_name]['learn_social_icon'] =  $learn_up_url;
                    
                    update_option('learn_soc_name_array', $learn_soc_array);
                    
                } 
            }
        }
    }
    if (!empty($learn_up_errors)){
        foreach ($learn_up_errors as $error) {
            ?>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>the upload fail</strong> <?=$error?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php
        }
    }