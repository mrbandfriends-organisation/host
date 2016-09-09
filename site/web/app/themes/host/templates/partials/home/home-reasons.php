<?php
  /**
  * HOME REASONS
  **/
    use Roots\Sage\Utils;
?>

<?php
  $reasons_title_1 = esc_html(get_field('reasons_title_1'));
  $reasons_title_2 = esc_html(get_field('reasons_title_2'));
  $reasons_content = get_field('reasons_content');

  $reasons_image = esc_html(get_field('reason_image')['url']);

  $reasons_items = get_field('reason_item');

  $reasons_button_text = esc_html(get_field('reasons_button_text'));
  $reasons_button_link = esc_html(get_field('reasons_button_link'));
?>

<?php $content_stuff = "
<h2>{$reasons_title_1}<br>{$reasons_title_2}</h2>

{$reasons_content}

<ul class=\"separated-list\">
    <li class=\"separated-list__item\">
        " . Utils\ob_load_template_part('templates/partials/shared/icon', array(
            "icon"          => "security-1",
            "classnames"    => "separated-list__icon svg-icon--id-card"
        )) . "
        Feature about Host here
    </li>
    <li class=\"separated-list__item\">
    " . Utils\ob_load_template_part('templates/partials/shared/icon', array(
        "icon"          => "computer",
        "classnames"    => "separated-list__icon svg-icon--id-card"
    )) . "
        Feature about Host here
    </li>
    <li class=\"separated-list__item\">
    " . Utils\ob_load_template_part('templates/partials/shared/icon', array(
        "icon"          => "security-1",
        "classnames"    => "separated-list__icon svg-icon--id-card"
    )) . "
        Feature about Host here
    </li>
    <li class=\"separated-list__item\">
    " . Utils\ob_load_template_part('templates/partials/shared/icon', array(
        "icon"          => "computer",
        "classnames"    => "separated-list__icon svg-icon--id-card"
    )) . "
        Feature about Host here
    </li>
    <li class=\"separated-list__item\">
    " . Utils\ob_load_template_part('templates/partials/shared/icon', array(
        "icon"          => "security-1",
        "classnames"    => "separated-list__icon svg-icon--id-card"
    )) . "
        Feature about Host here
    </li>
</ul>

<a href=\"{$reasons_button_link}\" class=\"btn split-feature__btn\">{$reasons_button_text}</a>
"
?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature.php', array(
    'second' => "<img src=\"{$reasons_image}\" />",
    'content' => $content_stuff,
    'align'   => "right",
    'color'   => "orange"
)); ?>
