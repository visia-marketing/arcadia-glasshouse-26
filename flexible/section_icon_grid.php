<?php
$per_row = get_sub_field('cards_per_row');
$divider = get_sub_field('columns_divider');
$icon_grid = get_sub_field('icon_grid');

switch ($per_row) {
    case 2:
        $class .= ' uk-width-1-1@xs uk-width-1-2@m';
        break;
    case 3:
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m';
        break;
    case 4:
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l';
        break; 
    default:
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-6@m'; // Default to 3 per uk-container
}

?>


<div class="icon-grid <?php echo $$divider.'-'.$per_row; ?> uk-grid uk-grid-large">

    <?php foreach($icon_grid as $card): ?>
        
        <div class="<?php echo $class; ?>">
            <div class="uk-card uk-flex">
                
                <div class="uk-card-media uk-flex uk-flex-center uk-flex-middle ">
                    <img  width="32" height="32" src="<?php echo $card['icon_svg'];?>" uk-svg  class="uk-preserve" >
                </div>

                <div class="uk-card-body uk-padding-remove">
                    <h3 class="uk-margin-top-remove g-section-caps-title"><?php echo $card['cell_content']['cell_title']; ?></h3>
                    <?php echo $card['cell_content']['card_text']; ?>
                </div>

            </div>
        </div>

    <?php endforeach; ?>

</div>