<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

require_once ("includes/admin-function.php");

$learn_is_social = learn_is_social();
?>
<div class="container" >
    <h1><?= esc_html( get_admin_page_title() ); ?></h1>
    <h3>רשתות חברתיות ליצירת קשר איתי</h3>
    <form enctype="multipart/form-data" action="" method="post">
        
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="custom-control custom-switch col-sm-7">
                <input type="checkbox" class="custom-control-input" id="my_check" name="learn_is_social" <?= $learn_is_social ? 'checked' : ''?>>
                <label class="custom-control-label" for="my_check">האם להפעיל את התוסף?</label>
            </div>    
        </div>

        <ul class="nav nav-tabs sticky-top my-sticky-top" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">רשתות</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> הגדרות</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="help-tab" data-toggle="tab" href="#help" role="tab" aria-controls="help" aria-selected="false">אודות</a>
            </li>
            <li class="nav-item">
                <div class="nav-link" id="save-button-tab"  aria-selected="false">
                    <?php submit_button( ' שמור שינויים ' ); ?> 
                </div>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
        <?php  
        $my_learn_soc_array = get_my_learn_soc_array();
        foreach ($my_learn_soc_array as $soc_name_arr ) {
          
            $learn_social_name = $soc_name_arr['social_name'] ;
            $learn_social_name_for_name = $soc_name_arr['the_social_name_for_name'];
            $learn_social_name_for_value = $soc_name_arr['the_social_val'];
            $learn_social_name_chek = $soc_name_arr['the_social_name_chek'];
            $learn_social_val_chek = $soc_name_arr['learn_social_val_chek'];
            $learn_social_icon = $soc_name_arr['learn_social_icon'];
            $name_for_file = $learn_social_name .'_learn_file_upload';
            
            ?>
                <div  class='card border-primary mb-3'>
                    <div class='card-title lead'>
                    <?=$learn_social_name?>
                    </div>
                    <div class='card-body'>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="<?=$learn_social_name?>" name='<?=$learn_social_name_chek?>' <?=$learn_social_val_chek == true ? ' checked' : ''?>>
                            <label class="custom-control-label" for="<?=$learn_social_name?>">האם להציג את הרשת הזו?</label>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class='col-sm-3'>קישור לרשת</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder='https://' name='<?=$learn_social_name_for_name?>' value='<?=$learn_social_name_for_value?>'>
                            <small class="form-text text-muted">הכנס קישור ישיר לרשת הזו</small>
                            </div>
                        </div> 
                            
                        <div class='form-group row'>
                            <div class='col-sm-4' id='icon-div'>
                                <p><?=$learn_social_icon ? " האייקון שמוצג : <img class='my_img' src='$learn_social_icon'>" : " נא להעלות אייקון <br> please upload an icon " ?></p>

                            </div>
                            <script>
                                

                            </script>
                            <div class="custom-file col-sm-7">
                                <label class="custom-file-label" for="<?=$learn_social_name?>_icon">|||||||||||||||||  בחר אייקון אחר</label>
                                <input type="file" class="custom-file-input"  name='<?=$name_for_file?>' id='<?=$learn_social_name?>_icon'>
                            </div>
                            
                        </div>
                    </div>    
                </div>
               
            <?php
        }
        ?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div  class='card border-primary mb-3'>
                    <div class='card-title lead'> הוסף או הסר רשת חברתית
                    </div>
                    <div class="form-group row">
                        <label class='col-sm-3'> הוספת רשת </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder=' שם הרשת ' name="learn_add_new_social_name">
                            <small class="form-text text-muted">ללא רווחים . אפשרי קו תחתון או קו אמצעי</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class='col-sm-4' for="inlineFormCustomSelect"> מחק רשת חברתית </label>
                        <div class="col-sm-6">
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"  name="learn_delete_social_name">
                                <option value="" selected>בחר...</option>
                                <?php
                                $my_learn_soc_array = get_my_learn_soc_array();
                                foreach ($my_learn_soc_array as $this_learn_soc_array ) {
                                    $soc_name = $this_learn_soc_array['social_name'];
                                    ?> 
                                    <option value="<?=$soc_name?>"><?=$soc_name?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                      
                </div>
                <?php $learn_what_page = get_option('learn_what_page');
               if(!$learn_what_page){
                   $learn_what_page = array();
               }
               ?>

                <div  class='card border-primary mb-3'>
                    <div class='card-title lead'> באיזה דפים להציג את התוסף 
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="learn_what_page[]" value="all"<?=(in_array("all" , $learn_what_page ))?"checked":''; ?>>
                        <label class="custom-control-label" for="customSwitch1"> בכל הדפים </label>
                    </div>
                    <hr>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" name="learn_what_page[]" value="is_front_page"<?=(in_array("is_front_page" , $learn_what_page ))?"checked":''; ?>>
                        <label class="custom-control-label" for="customSwitch2"> בדף ראשי </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" name="learn_what_page[]" value="post"<?=(in_array("post" , $learn_what_page ))?"checked":''; ?>>
                        <label class="custom-control-label" for="customSwitch3"> בכל הפוסטים </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customSwitch4" name="learn_what_page[]" value="page"<?=(in_array("page" , $learn_what_page ))?"checked":''; ?>>
                        <label class="custom-control-label" for="customSwitch4"> בכל העמודים </label>
                    </div>
                    <hr>
                    
                        
                        <?php
                    $learn_post_arr_name = learn_get_post_title();
                    foreach($learn_post_arr_name as $this_learn_post_name ){
                        ?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customSwitch-<?=$this_learn_post_name?>" name="learn_what_page[]" value="<?=$this_learn_post_name?>" <?=(in_array($this_learn_post_name , $learn_what_page ))?"checked":''; ?>>
                            <label class="custom-control-label" for="customSwitch-<?=$this_learn_post_name?>"><?=$this_learn_post_name?></label>
                        </div>
                        
                        <?php
                    }
                        ?>
                </div>
            </div>
            <div class="tab-pane fade" id="help" role="tabpanel" aria-labelledby="help-tab">
                <div  class='card border-primary mb-3'>
                    <div class='card-title lead'> אודות התוסף
                    </div>
                    <div class='card-body'>
                        <p> התוסף נבנה ע"י אליהו אוביץ </p>
                        <p> התוסף נבנה לצרכי לימוד </p>
                        <p>  בתוסף יהיה בעתיד אפשרות לעיצוב </p>
                    </div>
                </div>
                <div  class='card border-primary mb-3'>
                    <div class='card-title lead'> עזרה
                    </div>
                    <div class='card-body'>
                        <p>   בלשונית רשתות : אפשר להגדיר את הרשת הרצויה </p>
                        <ul class="list-group">
                            <li class="list-group-item">אם להציג את הרשת או לא</li>
                            <li class="list-group-item">הקישור לרשת</li>
                            <li class="list-group-item">בחירת אייקון לרשת</li>
                        </ul>
                        <p> בלשונית הגדרות </p>
                        <ul class="list-group">
                            <li class="list-group-item"> אפשר להוסיף או להסיר רשת חברתית</li>
                            <li class="list-group-item">לבחור באיזה דפים להציג את התוסף</li>
                        </ul>

                    </div>
                </div>
            </div>   
        </div>
     </form>
</div>
        