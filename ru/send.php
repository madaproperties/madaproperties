<?php if($_SERVER['REQUEST_METHOD'] === 'GET') {
    die;
}

$lang = 'en';

if(isset($_POST['lang']) && $_POST['lang'] != '') {
    $lang = trim(stripslashes(htmlspecialchars($_POST['lang'])));
}

$response = [];

if(isset($_POST['form_id']) && $_POST['form_id'] != '') {
    $form_id = trim(stripslashes(htmlspecialchars($_POST['form_id'])));

    $response['form_id'] = $form_id;
} else {
    $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
    $response['error']['log'] = 'The required "form_id" field is not filled in.';

    echo json_encode($response);
    die;
}

// Fields

$text = '';

if(isset($_POST['first_name'])) {
    if($_POST['first_name'] != '') {
        $first_name = trim(stripslashes(htmlspecialchars($_POST['first_name'])));

        $text .= ($lang == 'ru' ? 'Имя: ' : 'First Name: ') . $first_name;
    } else {
        $response['notices']['first_name'] = '<p>' . ($lang == 'ru' ? 'Пожалуйста, укажите ваше имя' : 'Please enter your fisrt name') . '</p>';
    }
}

if(isset($_POST['last_name'])) {
    if($_POST['last_name'] != '') {
        $last_name = trim(stripslashes(htmlspecialchars($_POST['last_name'])));

        $text .= '<br>' . ($lang == 'ru' ? 'Фамилия: ' : 'Last Name: ') . $last_name;
    } else {
        $response['notices']['last_name'] = '<p>' . ($lang == 'ru' ? 'Пожалуйста, укажите вашу фамилию' : 'Please enter your last name') . '</p>';
    }
}

if(isset($_POST['phone_number'])) {
    if($_POST['phone_number'] != '') {
        if(isset($_POST['country']) && $_POST['country'] != '') {
            $country = trim(stripslashes(htmlspecialchars($_POST['country'])));

            $text .= ($lang == 'ru' ? '<br>Страна: ' : '<br>Country: ') . $country;
        } else {
            $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
            $response['error']['log'] = 'The "country" field is not filled in.';

            echo json_encode($response);
            die;
        }

        $phone_number = trim(stripslashes(htmlspecialchars($_POST['phone_number'])));

        $text .= '<br>' . ($lang == 'ru' ? 'Номер телефона: ' : 'Phone Number: ') . $phone_number;

        if(isset($_POST['communication_method'])) {
            if($_POST['communication_method'] != '') {
                $text .= ($lang == 'ru' ? '<br>Способ связи: ' : '<br>Communication Method: ') . trim(stripslashes(htmlspecialchars($_POST['communication_method'])));
            } else {
                $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
                $response['error']['log'] = 'The "communication_method" field is not filled in.';

                echo json_encode($response);
                die;
            }
        }
    } else {
        $response['notices']['phone_number'] = '<p>' . ($lang == 'ru' ? 'Пожалуйста, укажите ваш номер телефона' : 'Please enter your phone number') . '</p>';
    }
}

if(isset($_POST['email'])) {
    if($_POST['email'] != '') {
        $email = filter_var(strtolower(trim(stripslashes(htmlspecialchars($_POST['email'])))), FILTER_SANITIZE_EMAIL);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $text .= '<br>Email: ' . $email;
        } else {
            $response['notices']['email'] = '<p>' . ($lang == 'ru' ? 'Пожалуйста, укажите корректный email' : 'Please enter the correct email') . '</p>';
        }
    } else {
        $response['notices']['email'] = '<p>' . ($lang == 'ru' ? 'Пожалуйста, укажите ваш email' : 'Please enter your email') . '</p>';
    }
}

if(isset($_POST['message']) && $_POST['message'] != '') {
    $message = trim(stripslashes(htmlspecialchars($_POST['message'])));

    $text .= '<br>' . ($lang == 'ru' ? 'Комментарий: ' : 'Message: ') . $message;
}

if(isset($_POST['ip']) && $_POST['ip'] != '') {
    $ip = trim(stripslashes(htmlspecialchars($_POST['ip'])));
}

if(isset($_POST['utm_source']) && $_POST['utm_source'] != '') {
    $utm_source = trim(stripslashes(htmlspecialchars($_POST['utm_source'])));
}

if(isset($_POST['utm_medium']) && $_POST['utm_medium'] != '') {
    $utm_medium = trim(stripslashes(htmlspecialchars($_POST['utm_medium'])));
}

if(isset($_POST['utm_campaign']) && $_POST['utm_campaign'] != '') {
    $utm_campaign = trim(stripslashes(htmlspecialchars($_POST['utm_campaign'])));
}

if(isset($_POST['utm_content']) && $_POST['utm_content'] != '') {
    $utm_content = trim(stripslashes(htmlspecialchars($_POST['utm_content'])));
}

if($form_id == 'quiz-form') {
    $text .= '<hr>';

    if(isset($_POST['service']) && $_POST['service'] != '') {
        $text .= '<br>' . ($lang == 'ru' ? 'Услуга: ' : 'Service: ') . trim(stripslashes(htmlspecialchars($_POST['service'])));
    } else {
        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'The "service" field is not filled in.';

        echo json_encode($response);
        die;
    }

    if(isset($_POST['kind_of_property']) && $_POST['kind_of_property'] != '') {
        $text .= '<br>' . ($lang == 'ru' ? 'Недвижимость: ' : 'Kind of property: ') . trim(stripslashes(htmlspecialchars($_POST['kind_of_property'])));
    } else {
        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'The "kind_of_property" field is not filled in.';

        echo json_encode($response);
        die;
    }

    if(isset($_POST['type_of_property']) && $_POST['type_of_property'] != '') {
        $type_of_property = trim(stripslashes(htmlspecialchars($_POST['type_of_property'])));

        $text .= '<br>' . ($lang == 'ru' ? 'Тип: ' : 'Type of property: ') . $type_of_property;
    } else {
        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'The "type_of_property" field is not filled in.';

        echo json_encode($response);
        die;
    }

    if(isset($_POST['district']) && is_array($_POST['district'])) {
        $text .= '<br>' . ($lang == 'ru' ? 'Район: ' : 'District: ') . '<ul style="margin: 0;">';

        foreach($_POST['district'] as $district) {
            $text .= '<li style="margin: 0;">' . trim(stripslashes(htmlspecialchars($district))) . '</li>';
        }

        $text .= '</ul>';
    } else {
        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'The "district" field is not filled in.';

        echo json_encode($response);
        die;
    }

    if($type_of_property == ($lang == 'ru' ? 'Квартира' : 'Apartment')) {
        if(isset($_POST['apartment_number_of_bedrooms']) && is_array($_POST['apartment_number_of_bedrooms'])) {
            $text .= '<br>' . ($lang == 'ru' ? 'Количество спален: ' : 'Number of bedrooms: ') . '<ul style="margin: 0;">';

            foreach($_POST['apartment_number_of_bedrooms'] as $number_of_bedrooms) {
                $text .= '<li style="margin: 0;">' . trim(stripslashes(htmlspecialchars($number_of_bedrooms))) . '</li>';
            }

            $text .= '</ul>';
        } else {
            $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
            $response['error']['log'] = 'The "apartment_number_of_bedrooms" field is not filled in.';

            echo json_encode($response);
            die;
        }

        if(isset($_POST['apartment_size']) && is_array($_POST['apartment_size'])) {
            $text .= '<br>' . ($lang == 'ru' ? 'Размер: ' : 'Size: ') . '<ul style="margin: 0;">';

            foreach($_POST['apartment_size'] as $size) {
                $text .= '<li style="margin: 0;">' . trim(stripslashes(htmlspecialchars($size))) . '</li>';
            }

            $text .= '</ul>';
        } else {
            $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
            $response['error']['log'] = 'The "apartment_size" field is not filled in.';

            echo json_encode($response);
            die;
        }
    } else {
        if(isset($_POST['villa_number_of_bedrooms']) && is_array($_POST['villa_number_of_bedrooms'])) {
            $text .= '<br>' . ($lang == 'ru' ? 'Количество спален: ' : 'Number of bedrooms: ') . '<ul style="margin: 0;">';

            foreach($_POST['villa_number_of_bedrooms'] as $number_of_bedrooms) {
                $text .= '<li style="margin: 0;">' . trim(stripslashes(htmlspecialchars($number_of_bedrooms))) . '</li>';
            }

            $text .= '</ul>';
        } else {
            $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
            $response['error']['log'] = 'The "villa_number_of_bedrooms" field is not filled in.';

            echo json_encode($response);
            die;
        }

        if(isset($_POST['villa_size']) && is_array($_POST['villa_size'])) {
            $text .= '<br>' . ($lang == 'ru' ? 'Размер: ' : 'Size: ') . '<ul style="margin: 0;">';

            foreach($_POST['villa_size'] as $size) {
                $text .= '<li style="margin: 0;">' . trim(stripslashes(htmlspecialchars($size))) . '</li>';
            }

            $text .= '</ul>';
        } else {
            $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
            $response['error']['log'] = 'The "villa_size" field is not filled in.';

            echo json_encode($response);
            die;
        }
    }

    if(isset($_POST['budget']) && is_array($_POST['budget'])) {
        $text .= '<br>' . ($lang == 'ru' ? 'Бюджет: ' : 'Budget: ') . '<ul style="margin: 0;">';

        foreach($_POST['budget'] as $budget) {
            $text .= '<li style="margin: 0;">' . trim(stripslashes(htmlspecialchars($budget))) . '</li>';
        }

        $text .= '</ul>';
    } else {
        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'The "budget" field is not filled in.';

        echo json_encode($response);
        die;
    }

    if(isset($_POST['purpose']) && $_POST['purpose'] != '') {
        $text .= '<br>' . ($lang == 'ru' ? 'Цель: ' : 'Purpose: ') . trim(stripslashes(htmlspecialchars($_POST['purpose'])));
    } else {
        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'The "purpose" field is not filled in.';

        echo json_encode($response);
        die;
    }
}

if($response['notices']) {
    echo json_encode($response);
    die;
}

// Sending emails

$email_subject = ($lang == 'ru' ? 'Новая заявка' : 'New request');

if(isset($_POST['subject']) && $_POST['subject'] != '') {
    $subject = trim(stripslashes(htmlspecialchars($_POST['subject'])));

    $email_subject .= ' - ' . $subject;
}

$mail = mail('admin-dxb@madaproperties.com', $email_subject, $text, "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\nFrom: Mada Properties <admin-dxb@madaproperties.com>\r\nReply-To: Mada Properties <admin-dxb@madaproperties.com>\r\n");

$curl = curl_init();

$token = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvbG1zLm1hZGFwcm9wZXJ0aWVzLmNvbVwvYXBpXC9sb2dpbiIsImlhdCI6MTYzMzAzNDg0MywibmJmIjoxNjMzMDM0ODQzLCJqdGkiOiJOalp5ZktDQWtyeEJVSk53Iiwic3ViIjozMywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.-SUTtA8DBPffXy3yu0Pip1GRtYbO49VanqkPL9_V4ow";

curl_setopt_array($curl, [
    CURLOPT_URL => "https://lms.madaproperties.com/api/new-contact",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => [
        'first_name' => $first_name,
        'last_name' => (isset($last_name) ? $last_name : ''),
        'country' => $country,
        'phone' => $phone_number,
        'email' => (isset($email) ? $email : ''),
        'message' => (isset($message) ? ($message . (isset($subject) ? ('<br><br>' . $subject) : '')) : (isset($subject) ? $subject : '')),
        'purpose' => 'buy',
        'assignedto' => '68',
        'last_mile_conversion' => 'Form',
        'source' => (isset($utm_source) ? $utm_source : ''),
        'medium' => (isset($utm_medium) ? $utm_medium : ''),
        'campaign' => (isset($utm_campaign) ? $utm_campaign : ''),
        'content' => (isset($utm_content) ? $utm_content : ''),
        'project_id' => 'Invest in Dubai',
        'lang' => $lang,
        'deal_ip' => $ip
    ],
    CURLOPT_HTTPHEADER => [$token],
]);

$res = curl_exec($curl);

curl_close($curl);

$json_response = json_decode($res, true);

if($json_response['msg'] === 'Created successfully' || strpos($json_response['msg'][0], 'lead exists before') !== false) {
    if($mail) {
        $subject_for_client = ($lang == 'ru' ? 'Мы получили вашу заявку - Mada Properties' : 'We have received your message - Mada Properties');

        $text_for_client = ($lang == 'ru' ? 'Спасибо, мы получили вашу заявку! Наши специалисты свяжутся с вами в ближайшее время.<br><br>Если у вас есть любые дополнительные вопросы вы всегда можете написать нам на почту - admin-dxb@madaproperties.com<br><br><br>С наилучшими пожеланиями,<br>Mada Properties' : 'Thank you for your message! Our specialists will contact you soon.<br><br>If you have any additional questions, you can always contact us by email - admin-dxb@madaproperties.com<br><br><br>Best regards,<br>Mada Properties');

        mail($email, $subject_for_client, $text_for_client, "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\nFrom: Mada Properties <admin-dxb@madaproperties.com>\r\nReply-To: Mada Properties <admin-dxb@madaproperties.com>\r\n");

        $response['success'] = '<p>' . ($lang == 'ru' ? 'Спасибо, ваша заявка успешно отправлена.' : 'Thank you! Your message has been sent successfully.') . '</p>';
    } else {
        // echo error_get_last()['message'];

        $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
        $response['error']['log'] = 'Failed to send message.';
    }
} else {
    $response['error']['text'] = '<p>' . ($lang == 'ru' ? 'Извините, возникла ошибка. Пожалуйста, перезагрузите страницу и&nbsp;попробуйте ещё&nbsp;раз.' : 'Sorry, an&nbsp;error has&nbsp;occurred. Please reload the&nbsp;page and&nbsp;try&nbsp;again.') . '</p>';
    $response['error']['log'] = 'Failed to create lead.';
}

echo json_encode($response);