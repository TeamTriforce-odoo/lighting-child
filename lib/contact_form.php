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
        if(count($year_list) == 40){
            $default_year = $i;
        }
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

    $shortcode = "<div class='select-btn'>[select* birth_year class:birth_text include_blank default:$default_year $year_value ]</div>年" .
        "<div class='select-btn'>[select* birth_month  include_blank class:birth_text $month_value]</div>月" .
        "<div class='select-btn'>[select* birth_day include_blank  class:birth_text $day_value]</div>日";
    return $obj->do_shortcode($shortcode);
}
wpcf7_add_form_tag(['birthday_select'], 'wpcf7_brithday_select', ['name-attr' => true]);

/*---------------------------------------------------------------------------
 * お問い合わせ画面のフォームバリデーション
 *---------------------------------------------------------------------------*/
function wpcf7_validate_customize_contact($result, $tags)
{
    if (!in_array($_POST['mode'], array('contact'), true)) {
        return $result;
    }

    // 確認用メールアドレスの整合性チェック
    if ($result->is_valid('user_email_confirm') && ($_POST['user_email'] !== $_POST['user_email_confirm'])) {
        $result->invalidate('user_email_confirm', '入力されたメールアドレスが異なっています。');
    }

    // お名前カナのチェック
    if (!preg_match("/\A[ァ-ヿ]+\z/u", strval($_POST['your-first-name-kana']))) {
        $result->invalidate('your-first-name-kana', '全角カタカナで入力してください。');
    }
    if (!preg_match("/\A[ァ-ヿ]+\z/u", strval($_POST['your-last-name-kana']))) {
        $result->invalidate('your-last-name-kana', '全角カタカナで入力してください。');
    }

    // 郵便番号
    if ($result->is_valid('your-zip') && !preg_match('/^\d{7}$/', strval($_POST['your-zip']))) {
        $result->invalidate('your-zip', '7桁半角数字で入力して下さい。');
    }

    // 市区町村
    if ($result->is_valid('your-address') && strlen($_POST['your-address']) == 0 ) {
        $result->invalidate('your-address', '正しい郵便番号を入力してください。');
    }

    // 電話番号のバリデーション
    // if ($result->is_valid('your-phonenumber') && !preg_match('/^\d{2,4}-\d{2,4}-\d{3,4}$/', strval($_POST['your-phonenumber']))) {
    //     $result->invalidate('your-phonenumber', '電話番号に間違いがあります。ハイフン（-）付き半角数字で入力して下さい。');
    // }

    return $result;
}
add_filter('wpcf7_validate', 'wpcf7_validate_customize_contact', 11, 2);

/*---------------------------------------------------------------------------
 * お問い合わせ画面のフォームバリデーション
 *---------------------------------------------------------------------------*/
function wpcf7_validate_customize_catalog($result, $tags)
{
    if (!in_array($_POST['mode'], array('catalog'), true)) {
        return $result;
    }

    // 確認用メールアドレスの整合性チェック
    if ($result->is_valid('user_email_confirm') && ($_POST['user_email'] !== $_POST['user_email_confirm'])) {
        $result->invalidate('user_email_confirm', '入力されたメールアドレスが異なっています。');
    }

    // お名前カナのチェック
    if (!preg_match("/\A[ァ-ヿ]+\z/u", strval($_POST['your-first-name-kana']))) {
        $result->invalidate('your-first-name-kana', '全角カタカナで入力してください。');
    }
    if (!preg_match("/\A[ァ-ヿ]+\z/u", strval($_POST['your-last-name-kana']))) {
        $result->invalidate('your-last-name-kana', '全角カタカナで入力してください。');
    }

    // 郵便番号
    if ($result->is_valid('your-zip') && !preg_match('/^\d{7}$/', strval($_POST['your-zip']))) {
        $result->invalidate('your-zip', '7桁半角数字で入力して下さい。');
    }

    // 市区町村
    if ($result->is_valid('your-address') && strlen($_POST['your-address']) == 0) {
        $result->invalidate('your-address', '正しい郵便番号を入力してください。');
    }

    return $result;
}
add_filter('wpcf7_validate', 'wpcf7_validate_customize_catalog', 11, 2);



/*---------------------------------------------------------------------------
 * RFC上正しくないメールアドレス(docomo, auの古いメアド)にメールが送られない件の対処
 *---------------------------------------------------------------------------*/

call_user_func(function () {
    ContactForm::getInstance();
});
