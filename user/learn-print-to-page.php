
        <?php
        if ( ! defined( 'ABSPATH' ) ) {
            die;
        }
        require_once ("includes/user-function.php");

        $learn_is_social = learn_is_social();
        $learn_is_this_page_selected = learn_is_this_page_selected(); //return true or false
        
        if( $learn_is_social && $learn_is_this_page_selected){
            ?>
            <div class='box'> 
                <h6>!contact us</h6>
            <?php
            $url = plugin_dir_url( __FILE__ ) . 'css/learn-print-to-page.css';
            wp_register_style( 'learn-print-to-page.css', $url );
            wp_enqueue_style( 'learn-print-to-page.css');
            $my_learn_soc_array = get_my_learn_soc_array();
            foreach ($my_learn_soc_array as $this_learn_soc_array ) {
               // myprint_r($this_learn_soc_array);
                $soc_name = $this_learn_soc_array['social_name'];
                $learn_social_val = $this_learn_soc_array['the_social_val'] ;
                $learn_social_val_chek = $this_learn_soc_array['learn_social_val_chek'] ;
                $learn_social_icon = $this_learn_soc_array['learn_social_icon'] ;
                if($learn_social_val_chek){
                   
                ?>
                <div class='box-row'>
                 <a href='<?=$learn_social_val?>'><?=$learn_social_icon ? "<img src='$learn_social_icon'>" : "<div class='my_soc'>$soc_name</div>" ?></a>
                </div>
                <?php  
                }
                
            
            }    
        ?>        
            
            
        </div>
        
        <?php
        }