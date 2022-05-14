<?php

class ContactForm
{
    static public function getInstance()
    {
        static $singleton = null;
        if (!$singleton) {
            $singleton = new static();
        }

        return $singleton;
    }
}

/*---------------------------------------------------------------------------
 * Contact Form 7 select default value
 *---------------------------------------------------------------------------*/
function set_select_default($fromName, $formValue, $tag)
{
    $name = $tag['name'];
    $value = $formValue;
    if ($name === $fromName) {
        // optionsの中から選択する項目を探す
        if (is_array($tag['values'])) {
            $index = array_search($value, $tag['values']);
            if ($index !== false) {
                // default: オプションの先頭は1なので+1する
                $index++;
                $defaultOption = 'default:' . $index;
                // selectタグにoptionsがあるか調べる
                if (!is_array($tag['options'])) {
                    // optionsがなければ作って default:オプションを追加
                    $tag['options'] = array($defaultOption);
                } else {
                    // optionsの中に既に default:オプションが有るか調べる
                    $is_defaultOption = false;
                    foreach ($tag['options'] as $key => $value) {
                        if (substr_compare($value, 'default', 0, 7) === 0) {
                            $is_defaultOption = true;
                            break;
                        }
                    }
                    if ($is_defaultOption) {
                        // defaultオプションを上書き
                        $tag['options'][$key] = $defaultOption;
                    } else {
                        // defaultオプションを追加
                        array_push($tag['options'], $defaultOption);
                    }
                }
            }
        }
    }
    return $tag;
}

/*---------------------------------------------------------------------------
 * Contact Form 7生年月日 独自のフォームタグを追加する
 *---------------------------------------------------------------------------*/
function wpcf7_brithday_select()
{
    $obj = WPCF7_ShortcodeManager::get_instance();
    $current_year = date("Y");
    $start_year = date("Y", strtotime("-70 year")); // 70歳まで
    $end_year = date("Y", strtotime("-18 year")); // 18歳から
    for ($i = $start_year; $i <= $end_year; $i++) {
        $year_list[] = $i;
    }
    $year_value = implode(' ', preg_replace("/^(.*?)$/", '"$1"', $year_list));
    for ($i = 1; $i <= 12; $i++) {
        $month_list[] = $i;
    }
    $month_value = implode(' ', preg_replace("/^(.*?)$/", '"$1"', $month_list));
    for ($i = 1; $i <= 31; $i++) {
        $day_list[] = $i;
    }
    $day_value = implode(' ', preg_replace("/^(.*?)$/", '"$1"', $day_list));

    $shortcode = "[select* birth_year class:birth_text include_blank default:61 $year_value ]年" .
        "[select* birth_month  include_blank class:birth_text $month_value]月" .
        "[select* birth_day include_blank  class:birth_text $day_value]日";
    return $obj->do_shortcode($shortcode);
}
wpcf7_add_form_tag(['birthday_select'], 'wpcf7_brithday_select', ['name-attr' => true]);



/*---------------------------------------------------------------------------
 * RFC上正しくないメールアドレス(docomo, auの古いメアド)にメールが送られない件の対処
 *---------------------------------------------------------------------------*/

call_user_func(function () {
    ContactForm::getInstance();
});
