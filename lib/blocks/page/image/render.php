<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(['hide','image_images', 'image_wrapper', 'koro_color']);

if(!$block->get('hide')) {

echo '<section class="b-image">';

    echo '<div class="b-image__'.$block->get('image_wrapper').'">';

        foreach ($block->get('image_images') as $image) {

            $imageCSS = "";
            $imageWrapperCSS = "";
            $imageWrapperClass = "";

            if($image['breakpoints']){
                $imageWrapperClass .= " h-visible-".$image['breakpoints'];
            }

            if($image['maximum_width']){

                $imageWrapperCSS .= "max-width:".$image['maximum_width']."px;";

            }

            if($image['image_height'] == "keep-height"){

                $imageCSS .= "height:".$image['image']['height']."px;";

            } else if ( ! empty( $image['image']['height'] ) && ! empty( $image['image']['width'] ) ) {

                $paddingTop = $image['image']['height']/$image['image']['width']*100;
                $imageCSS .= "padding-top:".$paddingTop."%;";

            }

            $imageCSS .= "background-image:url('".$image['image']['url']."');";
            include(__DIR__.'/templates/view.php');
    }

    echo '</div>';

echo '</section>';

}
